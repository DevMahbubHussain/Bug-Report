<?php

declare(strict_types=1);

use App\Helpers\App;
use App\Helpers\Config;

require_once __DIR__ . '/vendor/autoload.php';


$application = new App();
echo $application->getServerTime()->format('Y-m-d H:i:s') . PHP_EOL;
echo $application->isDebugMode() . PHP_EOL;
echo $application->getEnviornment() . PHP_EOL;
echo $application->getLogPath() . PHP_EOL;

// $config =  Config::get('app');

// var_dump($config);

if ($application->isRunningFromConsole()) {
    echo "running from console";
} else {
    echo "Running from Web Server";
}