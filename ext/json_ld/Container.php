<?php

namespace JsonLd;

abstract class Container
{

    /**
     * @var IGenerate[]
     */
    private static $services = [];

    public static function set($key, $value)
    {
        if (isset(static::$services[$key])) {
            throw new Exception("Key have been already registered!");
        } else {
            static::$services[$key] = $value;
        }
    }

    public static function get($key)
    {
        if (!isset(static::$services[$key])) {
            throw new Exception("Key doesn't exist!");
        } else {
            return static::$services[$key];
        }
    }

    public static function has($key)
    {
        return isset(static::$services[$key]);
    }

    public static function generate()
    {
        foreach (static::$services as $service) {
            echo "<script type='application/ld+json'>" .
                      $service->generate() .
                  "</script>";
        }
    }
}
