<?php

namespace App\Http;
use App\Http\Controller;
use App\Models\Test;

class TestController extends Controller{


    public function __construct(){
            $this->modal = Controller::instance(Test::class);
    }

    public function test()
    {
        return $this->modal->find(1);
    }


}

