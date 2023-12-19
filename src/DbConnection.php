<?php

namespace ToDoList;

use PDO;
use PDOException;

class DbConnection
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            $host = 'localhost';
            $db_name = 'todolist';
            $user = 'root';
            $password = '';

            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $user, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
