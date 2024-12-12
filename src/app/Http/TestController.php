<?php

namespace App\Http;
use App\Http\Controller;
use App\Models\Test;
use Support\Facades\Log;
use Exception;

class TestController{

    public function test()
    {
        try{

            
            $test = Test::find(3);

            if(!$test)
            {
                throw new Exception('User Not Found');
            }

            return response()->json($test);

        }catch(Exception $e)
        {
            Log::error('test in TestController '.$e->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>$e->getMessage()
                ]);
        }
       
    }

    public function test1()
    {
        Log::info('chec1k controller');
        $test = Test::all();
        
        return response()->json($test);
       
    }


}