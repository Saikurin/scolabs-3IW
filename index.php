<?php
session_start();

function myAutoloader($class)
{
    require("vendor/autoload.php");
    if (file_exists("core/" . $class . ".php")) {
        include "core/" . $class . ".php";
    } elseif (file_exists("models/" . $class . ".php")) {
        include "models/" . $class . ".php";
    } elseif (file_exists("exceptions/" . $class . ".exception.php")) {
        include "exceptions/" . $class . ".exception.php";
    }
 }

spl_autoload_register("myAutoloader");

new ConstantLoader();

$routes = yaml_parse_file("routes.yml");
$router = new Router($_SERVER["REQUEST_URI"]);

$router->load($routes);
$router->run();