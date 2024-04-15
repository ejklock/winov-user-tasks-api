<?php

namespace App\Domains\Auth\Exceptions;

use Exception;

class AuthFailedException extends Exception
{

    public function __construct($message = '', $code = 403)
    {
        parent::__construct("Auth failed: $message", $code);
    }
}
