<?php

namespace App\Http;
use App\Http\Controller;
use App\Models\User;
use Support\Facades\Log;
use Exception;

class UserController{

    public function getUser()
    {
        try{

            $user = User::find(2);

            if(!$user)
            {
                throw new Exception('User Not Found');
            }

            return response()->json(['status'=>'success','data'=>$user,'code'=>200]);

        }catch(Exception $e)
        {
            Log::error('getUser in UserController '.$e->getMessage());
            
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage(),
                'code'=>500
                ]);
        }
        
        
    }

    public function all()
    {
        // Log::info('chec1k controller');
        $users = User::all();
      
        print_r($users);
       
    }


}