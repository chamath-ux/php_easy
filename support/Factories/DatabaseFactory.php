<?php
namespace Support\Factories;
use Support\Database\Mysql;

class DatabaseFactory{

    private function __construct(){}

    public static function connect($connection)
    {
        if($connection == 'mysql')
        {
            return new Mysql();
        }

        return null;
    }
}