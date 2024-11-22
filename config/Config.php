<?php

namespace Config;

class Config{

    private static array $config= [];

    public static function get($key)
    {
        $segment = explode('.',$key);
        $file= $segment[0];
        $path = array_slice($segment, 1);


        if (!isset(self::$config[$file])) {
            $filePath = __DIR__ . "/../config/{$file}.php";
            if (!file_exists($filePath)) {
                throw new \Exception("Config file {$file}.php not found.");
            }
            self::$config[$file] = require $filePath;
        }

        // Traverse the config array for the requested path
        $value = self::$config[$file];
        foreach ($path as $segment) {
            if (!isset($value[$segment])) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
        
    }
}