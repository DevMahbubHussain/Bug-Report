<?php

namespace Tests\Units;

use App\Exception\InvalidLogLevelArgument;
use App\Helpers\App;
use App\Interfaces\LoggerInterface;
use App\Logger\Logger;
use App\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    private $logger;

    public function setUp(): void
    {
        $this->logger = new Logger;
        parent::setUp();
    }

    public function testItCanInstanceOfLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class, $this->logger);
    }

    // public function testInvalidLogLevel()
    // {
    //     $this->expectException(InvalidLogLevelArgument::class);
    //     $this->expectExceptionMessage('Invalid log level');

    //     // Call the log method with an invalid log level
    //     // $logger = new Logger();
    //     $this->logger->log('Testing Alert logs', 'invalidLogLevel');
    // }

    public function testInvalidLogLevel()
    {
        $this->expectException(InvalidLogLevelArgument::class);

        // Call the log method with an invalid log level
        // $logger = new YourLogger();
        $this->logger->log('Testing Alert logs', 'invalidLogLevel');
    }
    // public function testItCanCreateDifferentTypesOfLogLevel()
    // {
    //     $this->logger->info('Testing Info logs');
    //     $this->logger->error('Testing Error logs');
    //     $this->logger->log(LogLevel::ALERT, 'Testing Alert logs');
    //     $app = new App();

    //     $fileName = sprintf("%s/%s-%s.log", $app->getLogPath(), 'test', date("j.n.Y"));
    //     self::assertFileExists($fileName);

    //     $contentOfLogFile = file_get_contents($fileName);
    //     self::assertStringContainsString('Testing Info logs', $contentOfLogFile);
    //     self::assertStringContainsString('Testing Error logs', $contentOfLogFile);
    //     self::assertStringContainsString(LogLevel::ALERT, $contentOfLogFile);
    //     unlink($fileName);
    //     self::assertFileDoesNotExist($fileName);
    // }

    public function testItThrowsInvalidLogLevelArgumentExceptionWhenGivenAWrongLogLevel()
    {
        self::expectException(InvalidLogLevelArgument::class);
        $this->logger->log('invalid', 'Testing invalid log level');
    }
}
