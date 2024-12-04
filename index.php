<?php
require_once __DIR__.'/bootstrap/app.php';

use Support\app\AuthMiddleware;

use App\Http\TestController;

$test = new TestController();

$middleware = new AuthMiddleware;

echo"<pre>";
print_r($test->test(1));
echo"</pre>"; 
