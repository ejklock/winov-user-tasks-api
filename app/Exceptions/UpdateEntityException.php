<?php

namespace App\Exceptions;

use Exception;

class UpdateEntityException extends Exception
{
    public function __construct(string $message = '', int $httpCode = 500)
    {
        parent::__construct("Update entity failed: $message", $httpCode);
    }
}
