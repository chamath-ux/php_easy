<?php

namespace App\Http;

class Kernel {

    protected $routeMiddlewares = [
        'auth'=> \Support\app\AuthMiddleware::class,
        'auth1'=> \Support\app\AuthMiddleware1::class,
    ];
}
