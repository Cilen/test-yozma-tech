<?php


class User
{
    private static $pdo;

    public function __construct($name, $emails = null, $photos = null, $placesOfWork = null, $interests = null)
    {
        $userId = $this->setUser($name);
        $this->setEmails($emails, $userId);
        $this->setPhotos($photos, $userId);
        $this->setPlacesOfWork($placesOfWork, $userId);
        $this->setInterests($interests, $userId);

    }
    public static function setDb(PDO $pdo){
        self::$pdo = $pdo;
    }

    private function setUser($name){
        $sql = "INSERT INTO `users` (`name`)
                VALUES ('$name')";
        try{
            self::$pdo->exec($sql);
            $userId = self::$pdo->lastInsertId();
            return $userId;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function setEmails($emails, $userId){
        foreach ($emails as $email){
            $sql = "INSERT INTO `emails` (`email`, `user_id`)
                VALUES ('$email', '$userId')";
            try{
                self::$pdo->exec($sql);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    private function setPhotos($photos, $userId){
        foreach ($photos as $photo){
            $sql = "INSERT INTO `photos` (`photo`, `user_id`)
                VALUES ('$photo', '$userId')";
            try{
                self::$pdo->exec($sql);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    private function setPlacesOfWork($placesOfWork, $userId){
        foreach ($placesOfWork as $place){
            $sql = "INSERT INTO `places` (`place`, `user_id`)
                VALUES ('$place', '$userId')";
            try{
                self::$pdo->exec($sql);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    private function setInterests($interests, $userId){
        foreach ($interests as $interest){
            $sql = "INSERT INTO `interests` (`interest`, `user_id`)
                VALUES ('$interest', '$userId')";
            try{
                self::$pdo->exec($sql);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    public static function getAllUsers(){
        $allUsers = array();
        $sql = "SELECT users.user_id, users.name, emails.email, photos.photo, places.place, interests.interest FROM users 
                LEFT JOIN emails ON users.user_id = emails.user_id
                LEFT JOIN photos ON users.user_id = photos.user_id
                LEFT JOIN places ON users.user_id = places.user_id
                LEFT JOIN interests ON users.user_id = interests.user_id";
        try{
            $sth = self::$pdo->prepare($sql);
            $sth->execute();
            foreach ($sth->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP) as $resultsGroupByUserId){
                $allUsers[] = self::groupUserData($resultsGroupByUserId);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $allUsers;

    }

    public static function getUsersByName($userName){
        $allUsers = array();
        $sql = "SELECT users.user_id, users.name, emails.email, photos.photo, places.place, interests.interest FROM users 
                LEFT JOIN emails ON users.user_id = emails.user_id
                LEFT JOIN photos ON users.user_id = photos.user_id
                LEFT JOIN places ON users.user_id = places.user_id
                LEFT JOIN interests ON users.user_id = interests.user_id
                WHERE users.name = :name";
        try{
            $sth = self::$pdo->prepare($sql);
            $sth->execute(array(":name" => $userName));
            foreach ($sth->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP) as $resultsGroupByUserId){
                $allUsers[] = self::groupUserData($resultsGroupByUserId);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $allUsers;
    }

    public static function getUsersByInterest($interest){
        $allUsers = array();
        $sql = "SELECT users.user_id, users.name, emails.email, photos.photo, places.place, interests.interest FROM users 
                LEFT JOIN emails ON users.user_id = emails.user_id
                LEFT JOIN photos ON users.user_id = photos.user_id
                LEFT JOIN places ON users.user_id = places.user_id
                LEFT JOIN interests ON users.user_id = interests.user_id
                WHERE interests.interest = :interest";
        try{
            $sth = self::$pdo->prepare($sql);
            $sth->execute(array(":interest" => $interest));
            foreach ($sth->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP) as $resultsGroupByUserId){
                $allUsers[] = self::groupUserData($resultsGroupByUserId);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $allUsers;
    }

    //Group all user data in compact array
    protected static function groupUserData($data){
        $user = array();
        $user["name"] = $data[0]["name"];
        foreach ($data as $item) {
            if (!in_array($item["email"], $user["emails"])) $user["emails"][] = $item["email"];
            if (!in_array($item["photo"], $user["photos"])) $user["photos"][] = $item["photo"];
            if (!in_array($item["place"], $user["placesOfWork"])) $user["placesOfWork"][] = $item["place"];
            if (!in_array($item["interest"], $user["interests"])) $user["interests"][] = $item["interest"];
        }
        return $user;
    }

}