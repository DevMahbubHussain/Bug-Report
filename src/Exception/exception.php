<?php

use App\Exception\ExceptionHandler;

set_error_handler([new ExceptionHandler(), 'convertErrorsToException']);
set_exception_handler([new ExceptionHandler(), 'handler']);
