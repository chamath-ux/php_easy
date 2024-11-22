<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Support\Facades\Route;

Route::setBasePath('/api'); 
Route::loadRoutes(__DIR__ . '/../routes/api.php');
Route::setBasePath('');  
Route::loadRoutes(__DIR__ . '/../routes/web.php');
use Dotenv\Dotenv;
// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__.'/../') ;
$dotenv->load();

 