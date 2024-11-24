<?php

namespace Support\Facades;

use Support\Facade;
use Support\lib\Logger;

class Log extends Facade{

    protected static function getFacadeAccessor()
    {
        return Logger::class;
    }
}