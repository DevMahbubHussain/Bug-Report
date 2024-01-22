<?php

declare(strict_types=1);


use App\Helpers\App;
use App\Helpers\Config;
use App\Logger\Logger;
use App\Logger\LogLevel;

// use mysqli;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Exception/exception.php';
// $db = new mysqli("dkasdbkasd", "ajsdbakdbsa", "akjdbasd");
// $config = Config::getFileContent('hjbfsbfndbfdsnf');
// var_dump($config);



// $application = new App();
// echo $application->getServerTime()->format('Y-m-d H:i:s') . PHP_EOL;
// echo $application->isDebugMode() . PHP_EOL;
// echo $application->getEnviornment() . PHP_EOL;
// echo $application->getLogPath() . PHP_EOL;

// $config =  Config::get('app');
// var_dump($config);

// if ($application->isRunningFromConsole()) {
//     echo "running from console";
// } else {
//     echo "Running from Web Server";
// }

$app = new App();

echo $app->getLogPath();

$logger = new Logger();
$logger->log(
    LogLevel::EMERGENCY,
    'There is an emergency',
    ['exception' => 'excetion occured']
);
$logger->info('User account created successfully', ['id' => 5]);
