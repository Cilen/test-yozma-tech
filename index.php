<?php
spl_autoload_register(function ($class) {
    require_once 'Classes/' . $class . '.php';
});
require_once "route.php";

//Get DB config
$env = parse_ini_file('config.ini');
$db = DB::getInstance($env['db_host'], $env['db_name'], $env['db_user'], $env['db_pass']);
User::setDb($db);

$allUsers = User::getAllUsers($db);
if (count($allUsers) == 0){

    //Create tables
    Migration::createTables($db);

    //Import users data from json file
    $jsonContent = file_get_contents("users.json");
    $users = json_decode($jsonContent, true);
    foreach ($users['data'] as $user){
        $user = new User($user['name'], $user['emails'], $user['photos'], $user['placesOfWork'], $user['interests']);
    }
}


//Simpe API code
$responseData = route($_GET);

require_once "Templates/header.php";
require_once "Templates/content.php";
require_once "Templates/footer.php";
