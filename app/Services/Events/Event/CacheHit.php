<?php

namespace App\Services\Events\Event;

class CacheHit
{
    private string $key;

    /**
     * @var mixed
     */
    private $value;

    public function __construct(string $key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}
