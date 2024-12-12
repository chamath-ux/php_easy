<?php

namespace Support\app;

use Support\lib\Middleware;


class AuthMiddleware1 implements Middleware{

    public function handle($request, \Closure $next)
    {
        // var_dump($request);
        return $next($request);
    }
}