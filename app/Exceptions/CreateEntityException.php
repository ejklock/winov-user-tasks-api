<?php

namespace App\Exceptions;

use Exception;

class CreateEntityException extends Exception
{

    public function __construct(string $message = '', int $httpCode = 500)
    {
        parent::__construct("Create entity failed: $message", $httpCode);
    }
}
