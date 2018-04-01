<?php

declare(strict_types=1);

namespace Core;

class Hash
{
    private const REPEAT_HASH = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Hashes a string.
     *
     * @param string $string The string to hash
     *
     * @return string The hashed string
     */
    public static function generate(string $string): string
    {
        $rounds = sprintf('%02d', 10);
        $salt = substr(str_shuffle(str_repeat(self::REPEAT_HASH, 5)), 0, 22);

        return crypt($string, '$2a$' . $rounds . '$' . $salt);
    }

    /**
     * Compares a string to a hash.
     *
     * @param string $string The string
     * @param string $hash The Hash
     *
     * @return bool Does it match?
     */
    public static function compare(string $string, string $hash): bool
    {
        return crypt($string, $hash) === $hash;
    }
}
