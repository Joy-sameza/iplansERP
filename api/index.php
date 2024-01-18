<?php

declare(strict_types=1);

// Auto load classes
spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});
require "../include/config.php";

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Cache-Control: max-age=0");

// Handle errors and exceptions
set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$part = explode("/", $request);
$id = null;
$path = null;

if (array_key_exists(2, $part)) {
    if (is_numeric($part[2])) {
        $id = $part[2];
    } else {
        if (is_string($part[2])) {
            $path = $part[2];
        }
    }
}
//api personne
if ($part[1] == 'pers') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database(HOST_NAME, USER_NAME, USER_PASSWORD, DB_NAME);

    $personne = new Personne($database);

    $controllerP = new controllerP($personne);

    $controllerP->processRequest($method, $id, $path);
}

//api courrier
if ($part[1] == 'courrier') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database(HOST_NAME, USER_NAME, USER_PASSWORD, DB_NAME);

    $courrier = new Courrier($database);

    $controller = new Controller($courrier);

    $controller->processRequest($method, $id, $path);
}


// API MISSION
if ($part[1] == 'mission') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database(HOST_NAME, USER_NAME, USER_PASSWORD, DB_NAME);

    $courrier = new Mission($database);

    $controller = new ControllerM($courrier);

    $controller->processRequest($method, $id, $path);
}
// frais de mission
if ($part[1] == 'fraismission') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database(HOST_NAME, USER_NAME, USER_PASSWORD, DB_NAME);

    $courrier = new FraisMission($database);

    $controller = new ControllerF($courrier);

    $controller->processRequest($method, $id, $path);
}
//absence ou permission
if ($part[1] == 'permission') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database(HOST_NAME, USER_NAME, USER_PASSWORD, DB_NAME);

    $permission = new Permission($database);

    $controller = new ControllerPermission($permission);

    $controller->processRequest($method, $id, $path);
}

//site iplans
if ($part[1] == 'siteiplans') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database(HOST_NAME, USER_NAME, USER_PASSWORD, DB_NAME);
    $siteiplans= new Siteiplans($database);

    $controllersite = new Controllersite($siteiplans);

    $controllersite->processRequest($method, $id, $path);
}
if ($part[1] == 'user') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database(HOST_NAME, USER_NAME, USER_PASSWORD, DB_NAME);
    $user= new User($database);

    $controllersite = new ControllerUser($user);

    $controllersite->processRequest($method, $id, $path);
}