<?php

namespace App\Http;

class Kernel {

    protected $routeMiddlewares = [
        'auth'=> 'Support\app\AuthMiddleware',
        'auth1'=> 'Support\app\AuthMiddleware1',
    ];
}
