<?php

namespace Support\Facades;

use Support\Facade;
use Support\lib\Router;

class Route extends Facade{

    protected static function getFacadeAccessor()
    {
        return Router::class;
    }
}