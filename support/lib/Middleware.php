<?php

namespace Support\lib;

interface Middleware{

    public function handle($request, \Closure $next);
}