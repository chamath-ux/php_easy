<?php

use Support\Facades\Route;


Route::get('/home', function () {
    echo json_encode([
        ["id" => 1, "name" => "John Doe"],
        ["id" => 2, "name" => "Jane Doe"]
    ]);
});