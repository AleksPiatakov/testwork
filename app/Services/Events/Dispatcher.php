<?php

namespace App\Services\Events;

use Closure;
use Helpers\Arr;
use Helpers\Str;

class Dispatcher
{

    private static $instance = null;

    /**
     * The registered event listeners.
     */
    protected array $listeners = [];

    /**
     * The wildcard listeners.
     */
    protected array $wildcards = [];

    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Register an event listener with the dispatcher.
     * @param string|array $events
     * @param mixed $listener
     * @return void
     */
    public function listen($events, $listener)
    {
        foreach ((array)$events as $event) {
            if (Str::contains($event, '*')) {
                $this->setupWildcardListen($event, $listener);
            } else {
                $this->listeners[$event][] = $this->makeListener($listener);
            }
        }
    }

    /**
     * Setup a wildcard listener callback.
     * @param string $event
     * @param mixed $listener
     * @return void
     */
    protected function setupWildcardListen($event, $listener)
    {
        $this->wildcards[$event][] = $this->makeListener($listener, true);
    }

    /**
     * Register an event listener with the dispatcher.
     * @param Closure|string $listener
     * @param bool $wildcard
     * @return Closure
     */
    public function makeListener($listener, $wildcard = false)
    {
        if (is_string($listener)) {
            return $this->createClassListener($listener, $wildcard);
        }

        return function ($event, $payload) use ($listener, $wildcard) {
            if ($wildcard) {
                return $listener($event, $payload);
            }

            return $listener(...array_values($payload));
        };
    }

    /**
     * Create a class based listener using the IoC container.
     * @param string $listener
     * @param bool $wildcard
     * @return Closure
     */
    public function createClassListener($listener, $wildcard = false)
    {
        return function ($event, $payload) use ($listener, $wildcard) {
            if ($wildcard) {
                return call_user_func($this->createClassCallable($listener), $event, $payload);
            }

            $callable = $this->createClassCallable($listener);

            return $callable(...array_values($payload));
        };
    }

    /**
     * Create the class based event callable.
     * @param array|string $listener
     * @return callable
     */
    protected function createClassCallable($listener)
    {
        [$class, $method] = is_array($listener)
            ? $listener
            : $this->parseClassCallable($listener);

        return [new $class(), $method];
    }

    /**
     * Parse the class listener into class and method.
     * @param string $listener
     * @return array
     */
    protected function parseClassCallable($listener)
    {
        return Str::parseCallback($listener, 'handle');
    }

    /**
     * Fire an event and call the listeners.
     * @param string|object $event
     * @param mixed $payload
     * @return array
     */
    public function dispatch($event, $payload = [])
    {
        $responses = [];
        // When the given "event" is actually an object we will assume it is an event
        // object and use the class as the event name and this event itself as the
        // payload to the handler, which makes object based events quite simple.
        [$event, $payload] = $this->parseEventAndPayload(
            $event,
            $payload
        );

        foreach ($this->getListeners($event) as $listener) {
            $responses[] = $listener($event, $payload);
        }

        return $responses;
    }

    /**
     * Parse the given event and payload and prepare them for dispatching.
     * @param mixed $event
     * @param mixed $payload
     * @return array
     */
    protected function parseEventAndPayload($event, $payload)
    {
        if (is_object($event)) {
            [$payload, $event] = [[$event], get_class($event)];
        }

        return [$event, Arr::wrap($payload)];
    }

    /**
     * @param string $eventName
     * @return array
     */
    public function getListeners(string $eventName): array
    {
        $listeners = $this->listeners[$eventName] ?? [];

        return array_merge($listeners, $this->getWildcardListeners($eventName));
    }

    /**
     * Get the wildcard listeners for the event.
     * @param string $eventName
     * @return array
     */
    protected function getWildcardListeners($eventName)
    {
        $wildcards = [];

        foreach ($this->wildcards as $key => $listeners) {
            if (Str::is($key, $eventName)) {
                $wildcards = array_merge($wildcards, $listeners);
            }
        }

        return $wildcards;
    }
}
