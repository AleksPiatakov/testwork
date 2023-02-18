<?php

declare(strict_types=1);

namespace App\Classes\Cache\Store;

use App\Classes\Cache\Contracts\Store;
use App\Classes\Cache\InteractsWithTime;
use App\Classes\Cache\RetrievesMultipleKeys;

final class ArrayStore implements Store
{
    use InteractsWithTime;
    use RetrievesMultipleKeys;

    /**
     * The array of stored values.
     */
    protected array $storage = [];

    /**
     * Indicates if values are serialized within the store.
     */
    protected bool $serializesValues;

    /**
     * Create a new Array store.
     */
    public function __construct(bool $serializesValues = false)
    {
        $this->serializesValues = $serializesValues;
    }

    /**
     * Retrieve an item from the cache by key.
     * @param string|array $key
     * @return mixed
     */
    public function get($key)
    {
        if (!isset($this->storage[$key])) {
            return;
        }

        $item = $this->storage[$key];

        $expiresAt = $item['expiresAt'] ?? 0;

        if ($expiresAt !== 0 && $this->currentTime() > $expiresAt) {
            $this->forget($key);

            return;
        }

        return $this->serializesValues ? unserialize($item['value']) : $item['value'];
    }

    /**
     * Store an item in the cache for a given number of seconds.
     * @param string $key
     * @param mixed $value
     * @param int $seconds
     */
    public function put($key, $value, $seconds): bool
    {
        $this->storage[$key] = [
            'value' => $this->serializesValues ? serialize($value) : $value,
            'expiresAt' => $this->calculateExpiration($seconds),
        ];

        return true;
    }

    /**
     * Increment the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     */
    public function increment($key, $value = 1): int
    {
        if (!is_null($existing = $this->get($key))) {
            return tap(((int)$existing) + $value, function ($incremented) use ($key) {
                $value = $this->serializesValues ? serialize($incremented) : $incremented;

                $this->storage[$key]['value'] = $value;
            });
        }

        $this->forever($key, $value);

        return $value;
    }

    /**
     * Decrement the value of an item in the cache.
     * @param string $key
     * @param mixed $value
     */
    public function decrement($key, $value = 1): int
    {
        return $this->increment($key, $value * -1);
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
        if (array_key_exists($key, $this->storage)) {
            unset($this->storage[$key]);

            return true;
        }

        return false;
    }

    /**
     * Remove all items from the cache.
     */
    public function flush(): bool
    {
        $this->storage = [];

        return true;
    }

    /**
     * Get the cache key prefix.
     */
    public function getPrefix(): string
    {
        return '';
    }

    /**
     * Get the expiration time of the key.
     */
    protected function calculateExpiration(int $seconds): int
    {
        return $this->toTimestamp($seconds);
    }

    /**
     * Get the UNIX timestamp for the given number of seconds.
     */
    protected function toTimestamp(int $seconds): int
    {
        return $seconds > 0 ? $this->availableAt($seconds) : 0;
    }

}