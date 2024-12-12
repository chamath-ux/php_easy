<?php

use Support\lib\Response;

function env($key,$default)
{
    $value = $_ENV[$key];
    return  $value !== '' ? $value : $default;
}

if(!function_exists('response')){

    /**
     * Return a Response instance.
     * 
     * @return Response
     */

    function response()
    {
        return new Response();
    }
}
