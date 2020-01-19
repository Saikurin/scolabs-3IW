<?php

class helpers
{
    /**
     * @param $controller
     * @param $action
     * @return int|string
     */
    public static function getUrl($controller, $action): string
    {
        $listOfRoutes = yaml_parse_file("routes.yml");

        foreach ($listOfRoutes as $url => $route) {
            if ($route["controller"] == $controller && $route["action"] == $action) {
                return $url;
            }
        }

        die("Aucune correspondance pour la route");
    }

    /**
     * @return bool
     */
    public static function isAuth(): bool
    {
        return isset($_SESSION["auth"]);
    }

    /**
     * Check if user is auth. Else redirect to default controller
     */
    public static function checkAuth(): void
    {
        $url = (self::isAuth()) ? self::getUrl("dashboard", "index") : self::getUrl("default", "default");

        if ((!self::isAuth())) {
            header("Location: " . self::getUrl("default", "default"));
        }
    }

    /**
     * Check if request is https
     * @return bool
     */
    public static function isHttps()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? true : false;
    }
}
