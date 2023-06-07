<?php

namespace App\Core;

use Exception;
use PDO;
use PDOException;

class Database
{
    private static PDO $connection;

    /**
     * @throws Exception
     */
    public static function connect(): void
    {
        $dsn = 'mysql:host=localhost;dbname=db_praktisi;charset=utf8mb4';
        $username = 'root';
        $password = 'root';

        try {
            self::$connection = new PDO($dsn, $username, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function getConnection(): PDO
    {
        if (!isset(self::$connection)) {
            self::connect();
        }
        return self::$connection;
    }
}