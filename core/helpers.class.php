<?php

/**
 * Class helpers
 */
class helpers
{
    /**
     * @param $controller
     * @param $action
     * @param array $params
     * @return int|string
     */
    public static function getUrl($controller, $action,  $params = [])
    {
        $listOfRoutes = yaml_parse_file("routes.yml");

        foreach ($listOfRoutes as $url=>$route) {
            if ($route["controller"] == $controller && $route["action"]==$action) {
                return isset($route["params"]) ? str_replace("{" . $route["params"] . "}", $params[0], $url) : $url;
            }
        }

        die("Aucune correspondance pour la route");
    }
}
