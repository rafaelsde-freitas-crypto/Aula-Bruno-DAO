<?php

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {

            $host = "localhost";
            $dbname = "agenda";
            $user = "root";
            $pass = "";

            self::$connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $user,
                $pass
            );

            self::$connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$connection;
    }
}

?>