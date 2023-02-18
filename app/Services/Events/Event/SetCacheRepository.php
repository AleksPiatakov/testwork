<?php

namespace App\Services\Events\Event;

use App\Classes\Cache\Repository;

class SetCacheRepository
{
    private Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
}
