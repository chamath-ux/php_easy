<?php

namespace Support\lib;

class Logger{

    private $logFile;
    private $logLevel;

    const LEVEL_DEBUG = 'DEBUG';
    const LEVEL_INFO = 'INFO';
    const LEVEL_WARNING = 'WARNING';
    const LEVEL_ERROR = 'ERROR';


    private $logLevels = [
        self::LEVEL_DEBUG => 1,
        self::LEVEL_INFO => 2,
        self::LEVEL_WARNING => 3,
        self::LEVEL_ERROR => 4
    ];

    public function __construct($logFile=__DIR__.'/../../logs/php_easy_logs.log', $logLevel = self::LEVEL_INFO)
    {
        $this->logFile = $logFile;
        $this->logLevel = $logLevel;
    }

    // Method to log messages
    public function log($message, $level = self::LEVEL_INFO)
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
        $this->log($message, self::LEVEL_DEBUG);
    }

    public function info($message)
    {
        $this->log($message, self::LEVEL_INFO);
    }

    public function warning($message)
    {
        $this->log($message, self::LEVEL_WARNING);
    }

    public function error($message)
    {
        $this->log($message, self::LEVEL_ERROR);
    }
}