<?php

namespace Core;

class User
{
    /** @var stdClass The user fields */
    private static $userData;

    /**
     * @return string|void
     */
    public static function userName()
    {
        if (static::loggedIn()) {
            return static::$userData->user_name;
        }
    }

    /**
     * @return string|bool
     */
    public static function loggedIn()
    {
        return Session::showCookie('loggedIn');
    }

    /**
     * @return string
     */
    public static function userPicture()
    {
        if (static::loggedIn()) {
            return static::$userData->user_avatar;
        }
    }

    /**
     * @return int
     */
    public static function userId()
    {
        if (static::loggedIn()) {
            return static::$userData->user_id;
        }
    }
}