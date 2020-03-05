<?php
session_start();

function myAutoloader($class)
{
    if (file_exists("core/" . $class . ".class.php")) {
        include "core/" . $class . ".class.php";
    } elseif (file_exists("models/" . $class . ".model.php")) {
        include "models/" . $class . ".model.php";
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