<?php


class Migration
{
    // Tables structure
    protected static $tables = [
        "users" => "CREATE TABLE IF NOT EXISTS users(
                        user_id INT AUTO_INCREMENT,
                        name VARCHAR(255) NOT NULL,
                        PRIMARY KEY (user_id) 
                    ) ENGINE=INNODB",
        "emails" => "CREATE TABLE IF NOT EXISTS emails(
                        email_id INT AUTO_INCREMENT,
                        email VARCHAR(255) NOT NULL,
                        user_id INT,
                        PRIMARY KEY (email_id),
                        FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE
                    ) ENGINE=INNODB",
        "photos" => "CREATE TABLE IF NOT EXISTS photos(
                        photo_id INT AUTO_INCREMENT,
                        photo VARCHAR(255) NOT NULL,
                        user_id INT,
                        PRIMARY KEY (photo_id),
                        FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE
                    ) ENGINE=INNODB",
        "places_of_work" => "CREATE TABLE IF NOT EXISTS places(
                        place_id INT AUTO_INCREMENT,
                        place VARCHAR(255) NOT NULL,
                        user_id INT,
                        PRIMARY KEY (place_id),
                        FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE
                    ) ENGINE=INNODB",
        "interests" => "CREATE TABLE IF NOT EXISTS interests(
                        interest_id INT AUTO_INCREMENT,
                        interest VARCHAR(255) NOT NULL,
                        user_id INT,
                        PRIMARY KEY (interest_id),
                        FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE
                    ) ENGINE=INNODB"
    ];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    //Create tables
    public static function createTables(PDO $pdo){
        foreach (self::$tables as $tableName => $command){
            try{
                $pdo->exec($command);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}