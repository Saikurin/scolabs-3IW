<?php

use Scolabs\Core\ConstantLoader;
use Scolabs\Core\Router;

session_start();

function myAutoloader($class)
{

    require("vendor/autoload.php");
    $class = str_replace('Scolabs', '', $class);
    $class = str_replace('\\', '/', $class);
    if($class[0] === '/') {
        include substr($class.'.php', 1);
    } else {
        include $class.'.php';
    }
 }

spl_autoload_register("myAutoloader");

new ConstantLoader();

$routes = yaml_parse_file("routes.yml");
$router = new Router($_SERVER["REQUEST_URI"]);

$router->load($routes);
$router->run();