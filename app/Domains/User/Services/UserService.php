<?php

namespace App\Domains\User\Services;

use App\Domains\User\Exceptions\CreateUserException;
use App\Domains\User\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createUser(string $name, string $email, string $password)
    {
        try {
            return User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
        } catch (\Throwable $th) {
            throw new CreateUserException($th->getMessage());
        }
    }
}
