<?php

namespace Solomono;

/**
 * Class CSRF
 * @package Solomono
 */
class CSRF
{
    /**
     * Return key for hidden input field
     *
     * @return string
     */
    public static function key()
    {
        return "_csrf";
    }

    /**
     * Generate and return token
     *
     * @return mixed|string
     * @throws \Exception
     */
    public static function get()
    {
        if (empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = \RandomToken();
        }
        return $_SESSION['_csrf'];
    }

    /**
     *  Remove token from session
     */
    public static function flush()
    {
        $_SESSION['_csrf'] = null;
    }

    /**
     * @return bool
     */
    public static function isValid()
    {
        // fetch token from request
        // if token doesn't exist then use empty string
        $token = isset($_REQUEST[self::key()]) ? $_REQUEST[self::key()] : '';

        // compare fetched token and token stored in session
        $isSame = isset($_SESSION['_csrf']) ? $_SESSION['_csrf'] === $token : false;

        // remove token from session
        // we need to regenerate token for each validation
        self::flush();

        return $isSame;
    }
}
