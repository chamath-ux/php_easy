<?php

namespace Support\Helper;

class Router{

    private  $routes =[];

    public  function get($path, $callback)
    {
        $this->addRoute('GET', $path, $callback);
    }

    public  function post($path, $callback)
    {
        $this->addRoute('POST', $path, $callback);
    }

    private  function addRoute($method, $path, $callback)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback,
        ];
        $this->resolve();
    }

    private  function resolve()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                return call_user_func($route['callback']);
            }
        }
        return http_response_code(404);
    }
}