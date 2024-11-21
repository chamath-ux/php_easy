<?php

namespace Support\lib;

class Router{

    private $routes = [];
    private $basePath = '';

    public  function setBasePath($basePath) {
        $this->basePath = rtrim($basePath, '/');
        // print_r($this->basePath);
    }

    public function get($path,$callback)
    {
        $fullPath = $this->basePath . $path;
        // print_r($fullPath);
        $this->addRoute('GET',$fullPath,$callback);
    }

    public function post()
    {
        $fullPath = $this->basePath . $path;
        $this->addRoute('POST',$fullPath,$callback); 
    }

    public function loadRoutes($file)
    {
        // if(isset($file))
        // {
            require_once $file;
        // }
    }

    private function addRoute($method,$path,$callback)
    {
        // print_r($path);
        $this->routes[$method][$path] = $callback;
        $this->dispatch();
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Check for matching route
        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri]);
        } else {
            // $this->handleNotFound();
        }
    }

    private function handleNotFound() {
        if (strpos($_SERVER['REQUEST_URI'], '/api') === 0) {
            header('Content-Type: application/json');
            echo json_encode(["error" => "API route not found"]);
        } else {
            echo "404 - Page not found!";
        }
    }

}