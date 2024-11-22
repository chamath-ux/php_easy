<?php
function env($key,$default)
{
    $value = $_ENV[$key];
    return  $value !== '' ? $value : $default;
}
