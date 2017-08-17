<?php

namespace Core;

class User
{
    /** @var stdClass The user fields */
    private static $userData;

    /**
     * @return string|void
     */
    public static function getName()
    {
        if (static::loggedIn()) {
            return static::$userData->name;
        }
    }

    /**
     * @return string|bool
     */
    public static function isLoggedIn()
    {
        return Session::showCookie('loggedIn');
    }

    /**
     * @return string
     */
    public static function getPicture()
    {
        if (static::loggedIn()) {
            return static::$userData->userPicture;
        }
    }

    /**
     * @return int
     */
    public static function getId()
    {
        if (static::loggedIn()) {
            return static::$userData->userId;
        }
    }
}