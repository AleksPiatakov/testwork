<?php

declare(strict_types=1);

namespace App\Classes\Cache;

/**
 * @mixin CacheManager
 * @mixin Repository
 */
final class Cache
{
    private static CacheManager $instance;

    public static function __callStatic($method, $args)
    {
        if (!isset(self::$instance)) {
            self::$instance = new CacheManager();
        }
        return self::$instance->$method(...$args);
    }
}