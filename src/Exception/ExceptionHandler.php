<?php

namespace App\Exception;

use App\Helpers\App;
use ErrorException;
use Throwable;

class ExceptionHandler
{
    public function handler(Throwable $exception)
    {
        $app = new App();

        if ($app->isDebugMode()) {
            var_dump($exception);
        } else {
            echo "something went wrong";
        }
        exit;
    }
    public function convertErrorsToException($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }

    // private function parseExceptionResponse(Throwable $exception): array
    // {
    //     $response = [];
    //     $response['code'] = $exception->getCode();
    //     $response['message'] = $exception->getMessage();
    //     $response['line'] = $exception->getLine();
    //     $response['file'] = $exception->getFile();
    //     $response['trace'] = $exception->getTrace();

    //     $object = new ReflectionClass(get_class($exception));
    //     if ($object->isSubclassOf(Main::class)) {
    //         $response['data'] = $exception->getExtraData();
    //     }
    //     $response['exceptionClass'] = $object->getName();

    //     return $response;
    // }
}
