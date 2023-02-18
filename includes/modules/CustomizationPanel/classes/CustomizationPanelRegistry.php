<?php

class CustomizationPanelRegistry
{

    private static $container;

    public static function set($key, $value)
    {
        if (self::has($key)) {
            throw new \Exception('Key "{$key}" already exist!');
        } else {
            self::$container[$key] = $value;
        }
    }

    public static function has($key)
    {
        return isset(self::$container[$key]);
    }

    public static function get($key)
    {
        if (self::has($key)) {
            return self::$container[$key];
        } else {
            throw new \Exception('Key "{$key}" doesn\'t exist!');
        }
    }
}
