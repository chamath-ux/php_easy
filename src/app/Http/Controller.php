<?php

namespace App\Http;

class Controller{

    protected $modal;

    public static function instance($name)
    {
        return new $name;
    }
}