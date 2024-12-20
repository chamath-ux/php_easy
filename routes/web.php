<?php

use Support\Facades\Route;
use App\Http\TestController;
use App\Http\UserController;

/**
 * In here you can define Routes
 */
Route::get('/home2', [TestController::class,'test']);
Route::get('/home', [TestController::class,'test1']);
// Route::get('/user', [UserController::class,'getUser']);
// Route::get('/users', [UserController::class,'all']);
// Route::dispatch();
