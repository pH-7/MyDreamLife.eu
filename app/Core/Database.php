<?php

declare(strict_types=1);

namespace Core;

use PDO;
use PDOException;
use stdClass;

class Database
{
    /** @var null|PDO */
    private static $pdo = null;

    /** @var null|PDOStatement */
    private static $stmt = null;

    /**
     * Establishes a connection.
     *
     * @param array $dbDetails The database details
     */
    public static function connect(array $dbDetails = array()): void
    {
        try {
            static::$pdo = new PDO('mysql:host=' . $dbDetails['dbHost'] . ';dbname=' . $dbDetails['dbName'], $dbDetails['dbUser'], $dbDetails['dbPass']);
            static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            exit('<h1>An unexpected database error occured.</h1>');
        }
    }

    /**
     * Prepares a query and executes if applicable.
     *
     * @param string $sql The SQL to prepare
     * @param array $binds Values to bind to the query
     * @param bool $execute Automatically execute?
     */
    public static function query($sql, array $binds = array(), bool $execute = true): void
    {
        static::$stmt = static::$pdo->prepare($sql);

        foreach ($binds as $key => $value) {
            static::$stmt->bindValue($key, $value);
        }

        if ($execute === true) {
            static::$stmt->execute();
        }
    }

    /**
     * Returns the number of affected rows from the last executed query.
     *
     * @return int The number of affected rows
     */
    public static function rowCount(): int
    {
        return static::$stmt->rowCount();
    }

    /**
     * Returns a single row.
     *
     * @return stdClass|null The row as an object.
     */
    public static function fetch(): ?stdClass
    {
        return static::$stmt->fetch(PDO::FETCH_OBJ) ?? null;
    }

    public static function quote(string $string): string
    {
        return static::$pdo->quote($string);
    }

    /**
     * Returns all rows
     *
     * @return array|null The rows as an object.
     */
    public static function fetchAll(): ?array
    {
        return static::$stmt->fetchAll(PDO::FETCH_OBJ) ?? null;
    }
}
