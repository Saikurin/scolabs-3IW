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

$uri = $_SERVER["REQUEST_URI"];


$listOfRoutes = yaml_parse_file("routes.yml");


if (!empty($listOfRoutes[$uri])) {
    $c = $listOfRoutes[$uri]["controller"] . "Controller";
    $a = $listOfRoutes[$uri]["action"] . "Action";

    $pathController = "controllers/" . $c . ".class.php";

    if (file_exists($pathController)) {
        include $pathController;
        if (class_exists($c)) {
            $controller = new $c();
            if (method_exists($controller, $a)) {
                $controller->$a();
            } else {
                die("L'action' n'existe pas");
            }
        } else {
            die("La class controller n'existe pas");
        }
    } else {
        die("Le fichier controller n'existe pas");
    }
} else {
    die("L'url n'existe pas : Erreur 404");
}
