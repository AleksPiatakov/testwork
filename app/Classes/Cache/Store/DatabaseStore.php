<?php

declare(strict_types=1);

namespace App\Classes\Cache\Store;

use App\Classes\Cache\Contracts\Store;
use App\Classes\Cache\InteractsWithTime;
use App\Classes\Cache\RetrievesMultipleKeys;
use Closure;

final class DatabaseStore implements Store
{
    use InteractsWithTime;
    use RetrievesMultipleKeys;

    /**
     * A string that should be prepended to keys.
     */
    protected string $prefix;

    /**
     * The name of the cache table.
     */
    protected string $table;

    /**
     * Create a new database store.
     */
    public function __construct(string $table, string $prefix = '')
    {
        $this->table = $table;
        $this->prefix = $prefix;
    }

    /**
     * Retrieve an item from the cache by key.
     * @param string|array $key
     * @return mixed
     */
    public function get($key)
    {
        $prefixed = $this->prefix . $key;

        $cache = tep_db_query(sprintf("SELECT * FROM `%s` WHERE `key`='%s'", $this->table, $prefixed))
            ->fetch_all(MYSQLI_ASSOC);

        // If we have a cache record we will check the expiration time against current
        // time on the system and see if the record has expired. If it has, we will
        // remove the records from the database table so it isn't returned again.
        if (is_null($cache[0])) {
            return;
        }

        $cache = is_array($cache[0]) ? (object)$cache[0] : $cache[0];

        // If this cache expiration date is past the current time, we will remove this
        // item from the cache. Then we will return a null value since the cache is
        // expired. We will use "Carbon" to make this comparison with the column.
        if ($this->currentTime() >= $cache->expiration) {
            $this->forget($key);

            return;
        }

        return $this->unserialize($cache->value);
    }

    /**
     * Store an item in the cache for a given number of seconds.
     * @param string $key
     * @param mixed $value
     * @param int $seconds
     */
    public function put($key, $value, $seconds): bool
    {
        return $this->add($key, $value, $seconds);
    }

    /**
     * Store an item in the cache if the key doesn't exist.
     * @param string $key
     * @param mixed $value
     * @param int $seconds
     * @return bool
     */
    public function add($key, $value, $seconds)
    {
        $key = $this->prefix . $key;
        $value = $this->serialize($value);
        $expiration = $this->getTime() + $seconds;

        return tep_db_query(
            sprintf(
                "INSERT INTO `{$this->table}` (`%s`) VALUES('%s') ON DUPLICATE KEY UPDATE %s",
                implode('`, `', array_keys(compact('key', 'value', 'expiration'))),
                implode("', '", compact('key', 'value', 'expiration')),
                implode(', ', $this->concatenateKey(compact('key', 'value', 'expiration')))
            )
        );
    }

    private function concatenateKey(array $data, string $operator = '='): array
    {
        $cols = [];
        foreach ($data as $key => $val) {
            $cols[] = "`$key` {$operator} '$val'";
        }

        return $cols;
    }

    /**
     * Increment the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     * @return int|bool
     */
    public function increment($key, $value = 1)
    {
        return $this->incrementOrDecrement($key, $value, function ($current, $value) {
            return $current + $value;
        });
    }

    /**
     * Decrement the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     * @return int|bool
     */
    public function decrement($key, $value = 1)
    {
        return $this->incrementOrDecrement($key, $value, function ($current, $value) {
            return $current - $value;
        });
    }

    /**
     * Increment or decrement an item in the cache.
     * @param string $key
     * @param mixed $value
     * @param Closure $callback
     * @return int|bool
     */
    protected function incrementOrDecrement($key, $value, Closure $callback)
    {
        $prefixed = $this->prefix . $key;

        $cache = tep_db_query(sprintf("SELECT * FROM `%s` WHERE `key`='%s'", $this->table, $prefixed))
            ->fetch_all(MYSQLI_ASSOC);

        // If there is no value in the cache, we will return false here. Otherwise the
        // value will be decrypted and we will proceed with this function to either
        // increment or decrement this value based on the given action callbacks.
        if (is_null($cache[0])) {
            return false;
        }

        $cache = is_array($cache) ? (object)$cache : $cache;

        $current = $this->unserialize($cache->value);

        // Here we'll call this callback function that was given to the function which
        // is used to either increment or decrement the function. We use a callback
        // so we do not have to recreate all this logic in each of the functions.
        $new = $callback((int)$current, $value);

        if (!is_numeric($current)) {
            return false;
        }

        // Here we will update the values in the table. We will also encrypt the value
        // since database cache values are encrypted by default with secure storage
        // that can't be easily read. We will return the new value after storing.
        tep_db_perform($this->table, ['value' => $this->serialize($new)], 'update', "key={$prefixed}");

        return $new;
    }

    /**
     * Get the current system time.
     */
    protected function getTime(): int
    {
        return $this->currentTime();
    }

    /**
     * Store an item in the cache indefinitely.
     * @param string $key
     * @param mixed $value
     */
    public function forever($key, $value): bool
    {
        return $this->put($key, $value, 315360000);
    }

    /**
     * Remove an item from the cache.
     * @param string $key
     */
    public function forget($key): bool
    {
        return tep_db_query(sprintf("DELETE FROM `%s` WHERE `key`='%s'", $this->table, $this->prefix . $key));
    }

    /**
     * Remove all items from the cache.
     */
    public function flush(): bool
    {
        return tep_db_query(sprintf("DELETE FROM `%s`", $this->table));
    }

    /**
     * Get the cache key prefix.
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Serialize the given value.
     * @param mixed $value
     */
    protected function serialize($value): string
    {
        return serialize($value);
    }

    /**
     * Unserialize the given value.
     * @param string $value
     * @return mixed
     */
    protected function unserialize($value)
    {
        return unserialize($value);
    }
}