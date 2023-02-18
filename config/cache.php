<?php

use App\Classes\Cache\Contracts\Store;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    | Supported: "array", "database", "file",
    |            "memcached", "redis",
    |
    */

    'default' => env('CACHE_DRIVER', 'memcached'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    */

    'stores' => [
        Store::ARRAY => [
            'driver' => 'array',
            'serialize' => false,
        ],

        /*
         * CREATE TABLE `cached`
         *   (
         *       `key`        varchar(128) NOT NULL UNIQUE,
         *       `value`      text         NOT NULL,
         *       `expiration` bigint       NULL
         *   ) ENGINE = MyISAM
         *     DEFAULT CHARSET = utf8mb4
         *     COLLATE = utf8mb4_general_ci;
         */
        //need create table
        Store::DATABASE => [
            'driver' => 'database',
            'table' => 'cached',
        ],

        Store::FILE => [
            'driver' => 'file',
            'path' => rootPath('storage/cache'),
        ],

        Store::MEMCACHED => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        /*  Store::ARRAY => [
             'driver' => 'redis',
             'connection' => 'cache',
         ],*/
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    'prefix' => env('CACHE_PREFIX', env('APP_NAME', '_cache')),

];
