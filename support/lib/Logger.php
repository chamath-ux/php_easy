<?php

namespace Support\lib;
use Config\Config;

class Logger{

    private $logFile;
    private $logLevel;

    private $debug = 'DEBUG';
    private $info = 'INFO';
    private $warning = 'WARNING';
    private $error = 'ERROR';
    private $logLevels;

    public function __construct($logFile=__DIR__.'/../../logs/php_easy_logs.log')
    {
        $this->logFile = $logFile;
        $this->logLevel = Config::get('app.log_level');
        $this->logLevels = [
            $this->debug => 1,
            $this->info =>2,
            $this->warning =>3,
            $this->error => 4
        ];
    }

    // Method to log messages
    public function log($message, $level = 'INFO')
    {
        // Only log if the level is greater than or equal to the current log level
        if ($this->logLevels[$level] >= $this->logLevels[$this->logLevel]) {
            $timestamp = date('Y-m-d H:i:s');
            $formattedMessage = "[$timestamp] [$level] $message" . PHP_EOL;

            // Write the log to the file
            file_put_contents($this->logFile, $formattedMessage, FILE_APPEND);
        }
    }

    public function debug($message)
    {
        $this->log($message, 'DEBUG');
    }

    public function info($message)
    {
        $this->log($message, 'INFO');
    }

    public function warning($message)
    {
        $this->log($message, 'WARNING');
    }

    public function error($message)
    {
        $this->log($message, 'ERROR');
    }
}