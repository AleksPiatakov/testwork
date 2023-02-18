<?php

declare(strict_types=1);

namespace App\Classes\Cache\Store;

use App\Classes\Cache\Contracts\Store;
use App\Classes\Cache\RetrievesMultipleKeys;

class NullStore implements Store
{
    use RetrievesMultipleKeys;

    /**
     * Retrieve an item from the cache by key.
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        //
    }

    /**
     * Store an item in the cache for a given number of seconds.
     * @param string $key
     * @param mixed $value
     * @param int $seconds
     */
    public function put($key, $value, $seconds): bool
    {
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
        return false;
    }

    /**
     * Decrement the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     * @return int|bool
     */
    public function decrement($key, $value = 1)
    {
        return false;
    }

    /**
     * Store an item in the cache indefinitely.
     * @param string $key
     * @param mixed $value
     */
    public function forever($key, $value): bool
    {
        return false;
    }

    /**
     * Remove an item from the cache.
     * @param string $key
     */
    public function forget($key): bool
    {
        return true;
    }

    /**
     * Remove all items from the cache.
     */
    public function flush(): bool
    {
        return true;
    }

    /**
     * Get the cache key prefix.
     */
    public function getPrefix(): string
    {
        return '';
    }
}