<?php

class Router
{

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var array
     */
    private $namedRoutes = [];

    /**
     * Router constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function delete($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'DELETE');
    }

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * @param $path
     * @param $callable
     * @param $name
     * @param $method
     * @return Route
     */
    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            // TODO: Exception REQUEST_METHOD doesn't exist
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        // TODO: Exceptions No Matching routes
    }

    /**
     * @param $name
     * @param array $params
     * @return mixed
     */
    public function url($name, $params = [])
    {
        if (!isset($this->namedRoutes[$name])) {
            DangerException::fatalError('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

    /**
     * @param array $routes
     */
    public function load(array $routes)
    {
        foreach ($routes as $route => $params) {
            if (is_array($params["method"])) {
                foreach ($params['method'] as $method) {
                    /** @var Route $urlRouted */
                    $urlRouted = $this->{$method}($route, $params["controller"] . '#' . $params['action']);
                    if(isset($params['params'])) {
                        $urlRouted->secureParams($params['params']);
                    }
                }
            } else {
                /** @var Route $urlRouted */
                $urlRouted = $this->{$params["method"]}($route, $params["controller"] . '#' . $params['action']);
                if(isset($params['params'])) {
                    $urlRouted->secureParams($params['params']);
                }
            }
        }
    }

}