<?php

namespace Bootstrap;

use App\Services\Events\Event;
use App\Services\Events\Event\CacheForgotten;
use App\Services\Events\Event\CacheHit;
use App\Services\Events\Event\CacheMissed;
use App\Services\Events\Event\CacheWritten;
use App\Services\Events\Event\SetCacheRepository;

class EventServiceProvider
{
    protected array $listen = [
        SetCacheRepository::class => [],
        CacheMissed::class => [],
        CacheHit::class => [],
        CacheWritten::class => [],
        CacheForgotten::class => [],
    ];

    public function register()
    {
        foreach ($this->listen as $event => $listeners) {
            foreach (array_unique($listeners) as $listener) {
                Event::listen($event, $listener);
            }
        }
    }
}
