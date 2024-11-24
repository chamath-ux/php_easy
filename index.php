<?php
require_once __DIR__.'/bootstrap/app.php';

use Support\app\AuthMiddleware;

use App\Http\TestController;

$test = new TestController();

$middleware = new AuthMiddleware;
$request = [
    'url' => '/home',
    'method' => 'GET',
    'user' => 'John Doe', // Comment this to simulate an unauthorized request
];

print_r($middleware->handle($request, function($request){
    return "Final response: " . json_encode($request);
}));
echo"<pre>";
print_r($test->test(1));
echo"</pre>"; 
