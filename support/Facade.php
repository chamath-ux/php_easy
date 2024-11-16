<?php

namespace Support;

abstract class Facade{

 protected abstract  static function getFacadeAccessor();

 public static function __callStatic($method, $arguments)
 {
     $instance = static::resolveFacadeInstance(static::getFacadeAccessor());

     if (!method_exists($instance, $method)) {
         throw new Exception("Method {$method} does not exist on the facade target.");
     }

     return call_user_func_array([$instance, $method], $arguments);
 }

 protected static function resolveFacadeInstance($name)
 {
     return new $name;
 }

}