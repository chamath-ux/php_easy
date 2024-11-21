<?php

use Support\Facades\Route;


Route::get('/home1', function () {
    echo json_encode([
        ["id" => 1, "name" => "John Doe2"],
        ["id" => 2, "name" => "Jane Doe"]
    ]);
});