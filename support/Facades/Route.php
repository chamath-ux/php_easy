<?php

namespace Support\Facades;

use Support\Facade;
use Support\Helper\Router;

class Route extends Facade{

    protected static function getFacadeAccessor()
    {
        return Router::class;
    }
}