<?php

declare(strict_types=1);

namespace Core;

class Input
{
    /**
     * Returns the IP address of the user.
     *
     * @return string The IP address.
     */
    public static function userIp(): string
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Returns the agent of the user.
     *
     * @return string The user agent
     */
    public static function userAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Returns the value of a POST variable.
     *
     * @param string $key
     *
     * @return string|bool
     */
    public static function post(string $key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : false;
    }

    /**
     * Returns the value of a GET variable.
     *
     * @param string $key
     *
     * @return string|bool
     */
    public static function get(string $key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : false;
    }

    /**
     * Returns the value of a clean input.
     *
     * @param string $key
     *
     * @return string|bool
     */
    public static function clean(string $key)
    {
        return trim(addslashes(htmlentities($key)));
    }
}
