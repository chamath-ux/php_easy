<?php
namespace Support\Factories;
use Support\Database\Mysql;

class DatabaseFactory{

    public static function connect($connection)
    {
        if($connection == 'mysql')
        {
            return new Mysql();
        }

        return null;
    }
}