<?php

define('ROOT_DIR', dirname(__FILE__, 2));

(new Bootstrap\HandleExceptions())->registerErrorHandling();
(new Bootstrap\EventServiceProvider())->register();
(Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__)))->load();

/**
 * Function - facade to get environment variables
 * @param $key
 * @param null $default
 * @return string
 */
function env($key, $default = null)
{
    $value = getenv($key);

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return;
    }
    if ($value === false && $default) {
        return $default;
    }
    return $value;
}
