<?php

namespace App\Services\Events\Event;

class CacheWritten
{
    private string $key;

    /**
     * The value that was written.
     * @var mixed
     */
    private $value;

    /**
     * The number of seconds the key should be valid.
     */
    private ?int $seconds;

    public function __construct(string $key, $value, ?int $seconds = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->seconds = $seconds;
    }
}
