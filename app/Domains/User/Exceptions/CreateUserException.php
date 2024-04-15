<?php

namespace App\Domains\User\Exceptions;

use Exception;

class CreateUserException extends Exception
{

    public function __construct(string $message)
    {
        parent::__construct("Failed to create user: $message");
    }
}
