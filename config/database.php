<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {
    private static $host = '127.0.0.1';
    private static $db = 'myapi';
    private static $user = 'root';
    private static $pass = 'password';
    private static $charset = 'utf8mb4';
    private static $pdo;

    public static function connect(): PDO {
        if (!self::$pdo) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$pdo = new PDO($dsn, self::$user, self::$pass, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
    }
}
