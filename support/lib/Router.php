<?php

namespace Support\lib;
use App\Http\Kernel;

class Router extends Kernel{

    private $routes = [];
    private $middleware = [];

    public function middleware($name){
        return new $this($name);
    }

    public function __construct($middleware = null)
    {
        if ($middleware) {
            $this->middleware[] = $middleware;
        }
    }

    public function get($path,$callback)
    {
        $this->addRoute('GET',$path,$callback);
        return $this;
    }

    public function post()
    {
        $this->addRoute('POST',$path,$callback); 
        return $this;
    }

    private function addRoute($method,$path,$callback)
    {
        $this->routes[] = [
            'method'=> $method,
            'path'=> $path,
            'callback'=>$callback,
            'middleware' => $this->middleware
        ];
        $this->dispatch();
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


        foreach ($this->routes as $key => $route) {

            if($route['method'] == $method && $route['path'] == $uri)
            {
                $controller = new $route['callback'][0]();
                $action = $route['callback'][1];
                call_user_func([$controller, $action]);
                return;
            }else{
                $this->handleNotFound();
            }
            
        }

        return $this;
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