<?php

namespace Support\lib;

class Router{

    private $routes = [];

    public function get($path,$callback)
    {
        $this->addRoute('GET',$path,$callback);
    }

    public function post()
    {
        $this->addRoute('POST',$path,$callback); 
    }

    private function addRoute($method,$path,$callback)
    {
        // print_r($path);
        $this->routes[$method][$path] = $callback;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Check for matching route
        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri]);
        } else {
            $this->handleNotFound();
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