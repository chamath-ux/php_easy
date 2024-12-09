<?php

namespace App\Http;
use App\Http\Controller;
use App\Models\Test;
use Support\Facades\Log;

class TestController extends Controller{

    public function test()
    {
        Log::info('chec1k');
        return Test::find(1);
    }


}