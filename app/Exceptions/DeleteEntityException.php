<?php

namespace App\Exceptions;

use Exception;

class DeleteEntityException extends Exception
{

    public function __construct(string $message = '', int $httpCode = 500)
    {
        parent::__construct("Delete entity failed: $message", $httpCode);
    }
}
