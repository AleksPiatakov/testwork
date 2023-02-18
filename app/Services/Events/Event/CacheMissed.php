<?php

namespace App\Services\Events\Event;

class CacheMissed
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }
}
