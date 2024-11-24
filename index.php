<?php
require_once __DIR__.'/bootstrap/app.php';



use App\Http\TestController;

$test = new TestController();

echo"<pre>";
print_r($test->test(1));
echo"</pre>"; 
