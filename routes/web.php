<?php

use Support\Facades\Route;


Route::get('/home', function () {
    echo json_encode([
        ["id" => 1, "name" => "John Doe"],
        ["id" => 2, "name" => "Jane Doe"]
    ]);
     echo "Welcome to the homepage!";    
});

Route::get('/home1', function () {
    echo "Welcome to the homepage1!";
});