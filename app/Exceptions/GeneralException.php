<?php

namespace App\Exceptions;

use Exception;

class GeneralException extends Exception
{

    public function __construct(string $message = '', int $httpCode = 500)
    {
        parent::__construct($message, $httpCode);
    }
}
