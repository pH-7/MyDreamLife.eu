<?php

namespace Core;

class User
{
    /** @var stdClass The user fields */
    private static $userData;

    public static function store()
    {
        $bind = [
            'userid' => Session::showCookie('userId')
        ];

        if (Main::isLoggedIn()) {
            Database::query('SELECT * FROM users WHERE userId = :userid', $bind);
            static::$userData = Database::fetch();
        }
    }

    /**
     * @return string|void
     */
    public static function getName()
    {
        if (Main::isLoggedIn()) {
            return static::$userData->name;
        }
    }

    /**
     * @return string
     */
    public static function getPicture()
    {
        if (Main::isLoggedIn()) {
            return static::$userData->userPicture;
        }
    }

    /**
     * @return int
     */
    public static function getId()
    {
        if (Main::isLoggedIn()) {
            return static::$userData->userId;
        }
    }
}