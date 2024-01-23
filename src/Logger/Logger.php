<?php

namespace App\Logger;

use App\Exception\InvalidLogLevelArgument;
use App\Helpers\App;
use App\Interfaces\LoggerInterface;
use ReflectionClass;
use InvalidArgumentException;
// use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
    public function emergency($message, array $context = array())
    {
        $this->addRecord(LogLevel::EMERGENCY, $message, $context);
    }
    public function alert($message, array $context = array())
    {
        $this->addRecord(LogLevel::ALERT, $message, $context);
    }
    public function critical($message, array $context = array())
    {
        $this->addRecord(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = array())
    {
        $this->addRecord(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = array())
    {
        $this->addRecord(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = array())
    {
        $this->addRecord(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = array())
    {
        $this->addRecord(LogLevel::INFO, $message, $context);
    }
    public function debug($message, array $context = array())
    {
        $this->addRecord(LogLevel::DEBUG, $message, $context);
    }

    // public function log($level, $message, array $context = array())
    // {
    //     $validLogLevels = array_flip((new ReflectionClass(LogLevel::class))->getConstants());

    //     // Check if $level is a valid log level in a case-insensitive manner
    //     $normalizedLevel = strtoupper($level);
    //     if (!isset($validLogLevels[$normalizedLevel])) {
    //         throw new InvalidLogLevelArgument("Invalid log level: $level");
    //     }

    //     // Your actual logging logic goes here
    //     $this->addRecord($normalizedLevel, $message, $context);
    // }

    public function log($message, $level, $context = array())
    {
        // $object = new ReflectionClass(LogLevel::class);
        $validLogLevels = array_flip((new ReflectionClass(LogLevel::class))->getConstants());
        $normalizedLevel = strtoupper($level);
        if (!isset($validLogLevels[$normalizedLevel])) {
            throw new InvalidLogLevelArgument("Invalid log level: $level");
        }
        // if (!in_array($level, $validLogLevels)) {
        //     throw new InvalidLogLevelArgument($level, $validLogLevelsArray);
        // }
        $this->addRecord($level, $message, $context);
    }

    // public function log($level, $message, array $context = array())
    // {
    //     // Check if $level is a valid PSR-3 log level
    //     if (!defined(LogLevel::class . '::' . strtoupper($level))) {
    //         throw new InvalidLogLevelArgument("Invalid log level: $level");
    //     }

    //     // Your actual logging logic goes here
    //     $this->addRecord(strtoupper($level), $message, $context);
    // }

    private function addRecord(string $level, string $message,  $context = array())
    {
        $application = new App();
        $date = $application->getServerTime()->format('Y-m-d H:i:s');
        $logPath = $application->getLogPath();
        if (!file_exists($logPath)) {
            mkdir($logPath, 0755, true);
        }
        $env = $application->getEnviornment();
        $details = sprintf(
            "%s - Level: %s - Message: %s - Context: %s",
            $date,
            $level,
            $message,
            json_encode($context)
        ) . PHP_EOL;

        $fileName = sprintf("%s/%s-%s.log", $logPath, $env, date("j.n.Y"));
        $result = file_put_contents($fileName, $details, FILE_APPEND);
        if ($result === false) {
            error_log("Error writing to the log file: " . error_get_last()['message']);
        }
        // file_put_contents($fileName, $details, FILE_APPEND);
    }
}
