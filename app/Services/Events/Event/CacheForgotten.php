<?php

namespace App\Services\Events\Event;

class CacheForgotten
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }
}
