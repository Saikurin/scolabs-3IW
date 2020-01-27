<?php

/**
 * Class helpers
 */
class helpers
{
    /**
     * @param $controller
     * @param $action
     * @return int|string
     */
    public static function getUrl($controller, $action)
    {
        $listOfRoutes = yaml_parse_file("routes.yml");

        foreach ($listOfRoutes as $url=>$route) {
            if ($route["controller"] == $controller && $route["action"]==$action) {
                return $url;
            }
        }

        die("Aucune correspondance pour la route");
    }
}
