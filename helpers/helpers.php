<?php

use App\Services\Events\Event;

if (!function_exists('rootPath')) {
    /**
     * Return the path.
     */
    function rootPath(string $path = ''): string
    {
        $path = trim($path, '\/');
        return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR . $path : DIRECTORY_SEPARATOR);
    }
}

if (!function_exists('tap')) {
    /**
     * Call the given Closure with the given value then return the value.
     */
    function tap($value, callable $callback)
    {

        $callback($value);

        return $value;
    }
}

if (!function_exists('with')) {
    /**
     * Return the given value, optionally passed through the given callback.
     *
     * @param mixed $value
     * @param callable|null $callback
     * @return mixed
     */
    function with($value, callable $callback = null)
    {
        return is_null($callback) ? $value : $callback($value);
    }
}

if (!function_exists('event')) {
    /**
     * Dispatch an event and call the listeners.
     */
    function event(...$args): array
    {
        return Event::dispatch(...$args);
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     * @param mixed $value
     * @return mixed
     */
    function value($value, ...$args)
    {
        return $value instanceof Closure ? $value(...$args) : $value;
    }
}

if (!function_exists('windows_os')) {
    /**
     * Determine whether the current environment is Windows based.
     * @return bool
     */
    function windows_os()
    {
        return PHP_OS_FAMILY === 'Windows';
    }
}

if (!function_exists('isCLIMode')) {
    /**
     * Check if is CLI PHP.
     */
    function isCLIMode(): bool
    {
        return PHP_SAPI === 'cli';
    }
}

if (!function_exists("get_http_code")) {
    function get_http_code($url) {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        return $httpCode;
    }
}