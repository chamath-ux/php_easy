<?php

namespace App\Http;
use App\Http\Controller;
use App\Models\Test;

class TestController extends Controller{

    public function test()
    {
        return Test::find(1);
    }


}

