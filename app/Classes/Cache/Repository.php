<?php

declare(strict_types=1);

namespace App\Classes\Cache;

use App\Classes\Cache\Contracts\Store;
use App\Services\Events\Event\CacheForgotten;
use App\Services\Events\Event\CacheHit;
use App\Services\Events\Event\CacheMissed;
use App\Services\Events\Event\CacheWritten;
use ArrayAccess;
use Carbon\Carbon;
use Closure;
use DateInterval;
use DateTimeInterface;

final class Repository implements ArrayAccess
{
    use InteractsWithTime;

    protected Store $store;

    /**
     * The default number of seconds to store items.
     * @var int|null
     */
    protected int $default = 3600;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Determine if an item exists in the cache.
     * @param string $key
     */
    public function has($key): bool
    {
        return !is_null($this->get($key));
    }

    /**
     * Determine if an item doesn't exist in the cache.
     * @param string $key
     */
    public function missing($key): bool
    {
        return !$this->has($key);
    }

    /**
     * Retrieve an item from the cache by key.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (is_array($key)) {
            return $this->many($key);
        }

        $value = $this->store->get($this->itemKey($key));

        // If we could not find the cache value, we will fire the missed event and get
        // the default value for this cache value. This default could be a callback
        // so we will execute the value function which will resolve it if needed.
        if (is_null($value)) {
            event(new CacheMissed($key));

            $value = value($default);
        } else {
            event(new CacheHit($key, $value));
        }

        return $value;
    }

    /**
     * Retrieve multiple items from the cache by key.
     * Items not found in the cache will have a null value.
     * @param array $keys
     * @return array
     */
    public function many(array $keys)
    {
        $values = $this->store->many($keys);

        return array_map(function ($value, $key) use ($keys) {
            return $this->handleManyResult($keys, $key, $value);
        }, $values);
    }

    public function getMultiple($keys, $default = null)
    {
        $defaults = [];

        foreach ($keys as $key) {
            $defaults[$key] = $default;
        }

        return $this->many($defaults);
    }

    /**
     * Handle a result for the "many" method.
     * @param array $keys
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function handleManyResult($keys, $key, $value)
    {
        // If we could not find the cache value, we will fire the missed event and get
        // the default value for this cache value. This default could be a callback
        // so we will execute the value function which will resolve it if needed.
        if (is_null($value)) {
            event(new CacheMissed($key));

            return isset($keys[$key]) ? value($keys[$key]) : null;
        }

        // If we found a valid value we will fire the "hit" event and return the value
        // back from this function. The "hit" event gives developers an opportunity
        // to listen for every possible cache "hit" throughout this applications.
        event(new CacheHit($key, $value));

        return $value;
    }

    /**
     * Retrieve an item from the cache and delete it.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function pull($key, $default = null)
    {
        return tap($this->get($key, $default), function () use ($key) {
            $this->forget($key);
        });
    }

    /**
     * Store an item in the cache.
     * @param string $key
     * @param mixed $value
     * @param DateTimeInterface|DateInterval|int|null $ttl
     * @return bool
     */
    public function put($key, $value, $ttl = null)
    {
        if (is_array($key)) {
            return $this->putMany($key, $value);
        }

        if ($ttl === null) {
            return $this->forever($key, $value);
        }

        $seconds = $this->getSeconds($ttl);

        if ($seconds <= 0) {
            return $this->forget($key);
        }

        $result = $this->store->put($this->itemKey($key), $value, $seconds);

        if ($result) {
            event(new CacheWritten($key, $value, $seconds));
        }

        return $result;
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->put($key, $value, $ttl);
    }

    /**
     * Store multiple items in the cache for a given number of seconds.
     * @param array $values
     * @param DateTimeInterface|DateInterval|int|null $ttl
     * @return bool
     */
    public function putMany(array $values, $ttl = null)
    {
        if ($ttl === null) {
            return $this->putManyForever($values);
        }

        $seconds = $this->getSeconds($ttl);

        if ($seconds <= 0) {
            return $this->deleteMultiple(array_keys($values));
        }

        $result = $this->store->putMany($values, $seconds);

        if ($result) {
            foreach ($values as $key => $value) {
                event(new CacheWritten($key, $value, $seconds));
            }
        }

        return $result;
    }

    /**
     * Store multiple items in the cache indefinitely.
     */
    protected function putManyForever(array $values): bool
    {
        $result = true;

        foreach ($values as $key => $value) {
            if (!$this->forever($key, $value)) {
                $result = false;
            }
        }

        return $result;
    }

    public function setMultiple($values, $ttl = null)
    {
        return $this->putMany(is_array($values) ? $values : iterator_to_array($values), $ttl);
    }

    /**
     * Store an item in the cache if the key does not exist.
     * @param string $key
     * @param mixed $value
     * @param DateTimeInterface|DateInterval|int|null $ttl
     * @return bool
     */
    public function add($key, $value, $ttl = null)
    {
        if ($ttl !== null) {
            if ($this->getSeconds($ttl) <= 0) {
                return false;
            }

            // If the store has an "add" method we will call the method on the store so it
            // has a chance to override this logic. Some drivers better support the way
            // this operation should work with a total "atomic" implementation of it.
            if (method_exists($this->store, 'add')) {
                $seconds = $this->getSeconds($ttl);

                return $this->store->add(
                    $this->itemKey($key),
                    $value,
                    $seconds
                );
            }
        }

        // If the value did not exist in the cache, we will put the value in the cache
        // so it exists for subsequent requests. Then, we will return true so it is
        // easy to know if the value gets added. Otherwise, we will return false.
        if (is_null($this->get($key))) {
            return $this->put($key, $value, $ttl);
        }

        return false;
    }

    /**
     * Increment the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     * @return int|bool
     */
    public function increment($key, $value = 1)
    {
        return $this->store->increment($key, $value);
    }

    /**
     * Decrement the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     * @return int|bool
     */
    public function decrement($key, $value = 1)
    {
        return $this->store->decrement($key, $value);
    }

    /**
     * Store an item in the cache indefinitely.
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function forever($key, $value)
    {
        $result = $this->store->forever($this->itemKey($key), $value);

        if ($result) {
            event(new CacheWritten($key, $value));
        }

        return $result;
    }

    /**
     * Get an item from the cache, or execute the given Closure and store the result.
     * @param string $key
     * @param DateTimeInterface|DateInterval|int|null $ttl
     * @param Closure $callback
     * @return mixed
     */
    public function remember($key, $ttl, Closure $callback)
    {
        $value = $this->get($key);

        // If the item exists in the cache we will just return this immediately and if
        // not we will execute the given Closure and cache the result of that for a
        // given number of seconds so it's available for all subsequent requests.
        if (!is_null($value)) {
            return $value;
        }

        $this->put($key, $value = $callback(), $ttl);

        return $value;
    }

    /**
     * Get an item from the cache, or execute the given Closure and store the result forever.
     * @param string $key
     * @param Closure $callback
     * @return mixed
     */
    public function sear($key, Closure $callback)
    {
        return $this->rememberForever($key, $callback);
    }

    /**
     * Get an item from the cache, or execute the given Closure and store the result forever.
     * @param string $key
     * @param Closure $callback
     * @return mixed
     */
    public function rememberForever($key, Closure $callback)
    {
        $value = $this->get($key);

        // If the item exists in the cache we will just return this immediately
        // and if not we will execute the given Closure and cache the result
        // of that forever so it is available for all subsequent requests.
        if (!is_null($value)) {
            return $value;
        }

        $this->forever($key, $value = $callback());

        return $value;
    }

    /**
     * Remove an item from the cache.
     * @param string $key
     */
    public function forget($key): bool
    {
        return tap($this->store->forget($this->itemKey($key)), function ($result) use ($key) {
            if ($result) {
                event(new CacheForgotten($key));
            }
        });
    }

    public function delete($key)
    {
        return $this->forget($key);
    }

    public function deleteMultiple($keys)
    {
        $result = true;

        foreach ($keys as $key) {
            if (!$this->forget($key)) {
                $result = false;
            }
        }

        return $result;
    }

    public function clear()
    {
        return $this->store->flush();
    }

    /**
     * Format the key for a cache item.
     * @param string $key
     * @return string
     */
    protected function itemKey($key)
    {
        return $key;
    }

    /**
     * Get the default cache time.
     */
    public function getDefaultCacheTime(): ?int
    {
        return $this->default;
    }

    /**
     * Set the default cache time in seconds.
     */
    public function setDefaultCacheTime(?int $seconds = null): self
    {
        $this->default = $seconds;

        return $this;
    }

    /**
     * Get the cache store implementation.
     */
    public function getStore(): Store
    {
        return $this->store;
    }

    /**
     * Determine if a cached value exists.
     * @param string $key
     */
    public function offsetExists($key): bool
    {
        return $this->has($key);
    }

    /**
     * Retrieve an item from the cache by key.
     * @param string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Store an item in the cache for the default time.
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->put($key, $value, $this->default);
    }

    /**
     * Remove an item from the cache.
     * @param string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->forget($key);
    }

    /**
     * Calculate the number of seconds for the given TTL.
     * @param DateTimeInterface|DateInterval|int $ttl
     */
    protected function getSeconds($ttl): int
    {
        $duration = $this->parseDateInterval($ttl);

        if ($duration instanceof DateTimeInterface) {
            $duration = Carbon::now()->diffInRealSeconds($duration, false);
        }

        return (int)$duration > 0 ? $duration : 0;
    }

    /**
     * Handle dynamic calls into macros or pass missing methods to the store.
     */
    public function __call(string $method, $parameters)
    {
        return $this->store->$method(...$parameters);
    }

    public function __clone()
    {
        $this->store = clone $this->store;
    }
}