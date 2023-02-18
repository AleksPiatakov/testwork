<?php

namespace App\Logger;

/**
 * @mixin LogManager
 */
class Log
{
    private static $instance;

    public static function __callStatic($method, $args)
    {
        if (!isset(self::$instance)) {
            self::$instance = new LogManager();
        }
        return self::$instance->$method(...$args);
    }
}
