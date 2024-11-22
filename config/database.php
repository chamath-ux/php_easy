<?php

return[
    
    //default connection to database
    'default'=>env('DB_CONNECTION','mysql'),


    /* database connections */

    'connections'=>
    [
        'mysql'=>[
            'driver'=>'mysql',
            'host'=>env('DB_HOST','localhost'),
            'username'=>env('DB_USERNAME',''),
            'password'=>env('DB_PASSWORD',''),
            'database'=>env('DB_DATABASE','php_easy'),
            'port'=>env('DB_PORT','3306'),

        ]
    ]
];