<?php

namespace Core;

class Main
{
    /** @var array */
    private static $config = array();

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        return (bool) Session::showCookie('loggedIn');
    }

    /**
     * Stores the config values into a property.
     *
     * @return void
     */
    public static function store()
    {
        if (empty(static::$config)) {
            include_once APP_PATH . 'config/config.php';
            static::$config = $config;
        }
    }

    /**
     * Returns a config value.
     *
     * @param string $key The key
     * @param string $secondKey Optional second key
     *
     * @return string|bool The value
     */
    public static function get($key, $secondKey = '')
    {
        if (empty($secondKey)) {
            return isset(static::$config[$key]) ? static::$config[$key] : false;
        } else {
            return isset(static::$config[$key][$secondKey]) ? static::$config[$key][$secondKey] : false;
        }
    }
}