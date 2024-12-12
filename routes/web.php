<?php

use Support\Facades\Route;
use App\Http\TestController;
use App\Http\UserController;

/**
 * In here you can define Routes
 */

Route::middleware('auth')->get('/home', [TestController::class,'test']);
Route::middleware('auth')->get('/home2', [TestController::class,'test1']);
Route::middleware('auth')->get('/user', [UserController::class,'getUser']);
