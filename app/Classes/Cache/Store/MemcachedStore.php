<?php

declare(strict_types=1);

namespace App\Classes\Cache\Store;

use App\Classes\Cache\Contracts\Store;
use App\Classes\Cache\InteractsWithTime;
use Memcached;
use ReflectionMethod;

final class MemcachedStore implements Store
{
    use InteractsWithTime;

    protected Memcached $memcached;

    /**
     * A string that should be prepended to keys.
     */
    protected string $prefix;

    /**
     * Indicates whether we are using Memcached version >= 3.0.0.
     */
    protected bool $onVersionThree;

    /**
     * Create a new Memcached store.
     */
    public function __construct(Memcached $memcached, string $prefix = '')
    {
        $this->setPrefix($prefix);
        $this->memcached = $memcached;

        $this->onVersionThree = (new ReflectionMethod('Memcached', 'getMulti'))
                ->getNumberOfParameters() == 2;
    }

    /**
     * Retrieve an item from the cache by key.
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        $value = $this->memcached->get($this->prefix . $key);

        if ($this->memcached->getResultCode() == 0) {
            return $value;
        }
    }

    /**
     * Retrieve multiple items from the cache by key.
     * Items not found in the cache will have a null value.
     */
    public function many(array $keys): array
    {
        $prefixedKeys = array_map(function ($key) {
            return $this->prefix . $key;
        }, $keys);

        if ($this->onVersionThree) {
            $values = $this->memcached->getMulti($prefixedKeys, Memcached::GET_PRESERVE_ORDER);
        } else {
            $null = null;

            $values = $this->memcached->getMulti($prefixedKeys, $null, Memcached::GET_PRESERVE_ORDER);
        }

        if ($this->memcached->getResultCode() != 0) {
            return array_fill_keys($keys, null);
        }

        return array_combine($keys, $values);
    }

    /**
     * Store an item in the cache for a given number of seconds.
     * @param string $key
     * @param mixed $value
     * @param int $seconds
     */
    public function put($key, $value, $seconds): bool
    {
        return $this->memcached->set(
            $this->prefix . $key,
            $value,
            $this->calculateExpiration($seconds)
        );
    }

    /**
     * Store multiple items in the cache for a given number of seconds.
     * @param int $seconds
     */
    public function putMany(array $values, $seconds): bool
    {
        $prefixedValues = [];

        foreach ($values as $key => $value) {
            $prefixedValues[$this->prefix . $key] = $value;
        }

        return $this->memcached->setMulti(
            $prefixedValues,
            $this->calculateExpiration($seconds)
        );
    }

    /**
     * Store an item in the cache if the key doesn't exist.
     * @param mixed $value
     */
    public function add(string $key, $value, ?int $seconds = null): bool
    {
        return $this->memcached->add(
            $this->prefix . $key,
            $value,
            $this->calculateExpiration($seconds)
        );
    }

    /**
     * Increment the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     * @return int|bool
     */
    public function increment($key, $value = 1)
    {
        return $this->memcached->increment($this->prefix . $key, $value);
    }

    /**
     * Decrement the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     * @return int|bool
     */
    public function decrement($key, $value = 1)
    {
        return $this->memcached->decrement($this->prefix . $key, $value);
    }

    /**
     * Store an item in the cache indefinitely.
     * @param string $key
     * @param mixed $value
     */
    public function forever($key, $value): bool
    {
        return $this->put($key, $value, 0);
    }

    /**
     * Remove an item from the cache.
     * @param string $key
     */
    public function forget($key): bool
    {
        return $this->memcached->delete($this->prefix . $key);
    }

    /**
     * Remove all items from the cache.
     * @return bool
     */
    public function flush(): bool
    {
        return $this->memcached->flush();
    }

    /**
     * Get the expiration time of the key.
     */
    protected function calculateExpiration(?int $seconds = null): int
    {
        return $this->toTimestamp($seconds);
    }

    /**
     * Get the UNIX timestamp for the given number of seconds.
     */
    protected function toTimestamp(?int $seconds = null): int
    {
        return $seconds > 0 ? $this->availableAt($seconds) : 0;
    }

    public function getMemcached(): Memcached
    {
        return $this->memcached;
    }

    /**
     * Get the cache key prefix.
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Set the cache key prefix.
     */
    public function setPrefix(string $prefix = ''): void
    {
        $this->prefix = !empty($prefix) ? $prefix . ':' : '';
    }
}