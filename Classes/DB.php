<?php


class DB
{
    private static $objInstance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    //Create and return PDO object
    public static function getInstance($db_host, $db_name, $db_user, $db_pass)
    {
        try{
            if (!self::$objInstance) {
                self::$objInstance = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

        return self::$objInstance;

    }
}

