<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';

use Support\Database\Model;

use Dotenv\Dotenv;
// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__.'/../') ;
$dotenv->load();
Model::setConnection();

 