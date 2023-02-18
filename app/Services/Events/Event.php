<?php

namespace App\Services\Events;

/**
 * @mixin Dispatcher
 */
class Event
{
    private static $instance;

    public static function __callStatic($method, $args)
    {
        if (!isset(self::$instance)) {
            self::$instance = Dispatcher::getInstance();
        }
        return self::$instance->$method(...$args);
    }
}
