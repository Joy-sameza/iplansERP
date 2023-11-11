<?php

declare(strict_types=1);

// Auto load classes
spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

require_once "./../include/config.php";

header('Access-Control-Allow-Origin: ' . SITE_URL);
header("Content-Type: application/json; charset=UTF-8");

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

    $database = new Database("localhost", "administrator", "system", "demo", "5785");

    $personne = new Personne($database);

    $controllerP = new controllerP($personne);

    $controllerP->processRequest($method, $id, $path);
}

//api courrier
if ($part[1] == 'courrier') {
    ini_set("date.timezone", "Africa/Douala");

    $database = new Database("localhost", "administrator", "system", "demo", "5785");

    $courrier = new Courrier($database);

    $controller = new Controller($courrier);

    $controller->processRequest($method, $id, $path);
}


