<?php

namespace Support\Facades;

use Support\Facade;
use Support\Database\DB as Query;


class DB extends Facade{
    protected static function getFacadeAccessor()
    {
        return Query::class;
    }
}