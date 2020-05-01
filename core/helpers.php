<?php
namespace Scolabs\core;

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
                if(isset($params)) {
                    foreach ($params as $param => $value) {
                        $url = str_replace(':'.$param, $value, $url);
                    }
                }
                return $url;
            }
        }

        die("Aucune correspondance pour la route");
    }
}
