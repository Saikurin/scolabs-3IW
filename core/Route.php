<?php

namespace Scolabs\Core;

class Route
{

    /**
     * @var string
     */
    private $path;

    /**
     * @var mixed
     */
    private $callable;

    /**
     * @var array
     */
    private $matches = [];

    /**
     * @var array
     */
    private $params = [];

    /**
     * Route constructor.
     * @param $path
     * @param $callable
     */
    public function __construct($path, $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * @param $param
     * @param $regex
     * @return $this
     */
    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    /**
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * @param $match
     * @return string
     */
    private function paramMatch($match)
    {
        if (isset($this->params[$match[1]])) {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    /**
     * @return mixed
     */
    public function call()
    {
        if (is_string($this->callable)) {
            $params = explode('#', $this->callable);
            $controller = $params[0] . "Controller";
            if (file_exists("controllers/" . $controller . ".php")) {
                include "controllers/" . $controller . ".php";
                if (class_exists($controller)) {
                    $controller = new $controller();
                }
            }
            return call_user_func_array([$controller, $params[1] . "Action"], $this->matches);
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }

    /**
     * @param $params
     * @return string|string[]
     */
    public function getUrl($params)
    {
        $path = $this->path;
        foreach ($params as $k => $v) {
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }

    /**
     * @param array $params
     */
    public function secureParams(array $params)
    {
        foreach ($params as $regex) {
            $this->with(key($regex), $regex[key($regex)]);
        }
    }
}