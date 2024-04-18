<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Exceptions\AuthFailedException;
use App\Domains\User\Services\UserService;
use App\Exceptions\CreateEntityException;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    /**
     * Registers a new user.
     *
     * @param string $name The name of the user.
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     * @throws Exception If an error occurs during the registration process.
     * @return User The result of the registration process.
     */
    public static function registerUser(string $name, string $email, string $password)
    {
        try {
            return UserService::createUser($name, $email, $password);
        } catch (\Throwable $th) {
            throw new CreateEntityException($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Logs in a user with the specified email and password.
     *
     * @param string $email The user's email.
     * @param string $password The user's password.
     * @throws AuthFailedException If login fails.
     * @return array The access token, token type, and expiration time.
     */
    public static function loginUser(string $email, string $password)
    {
        if (!$token = auth()->attempt(['email' => $email, 'password' => $password])) {
            throw new AuthFailedException('Invalid credentials', 401);
        }

        return self::generateTokenResponse($token);
    }

    public static function logout()
    {
        return  auth()->logout();
    }

    public static function refresh()
    {
        $newToken = Auth::refresh();

        Auth::invalidate(true, true);

        return self::generateTokenResponse($newToken);
    }

    private static function generateTokenResponse($token, $type = 'bearer')
    {

        return [
            'access_token' => $token,
            'token_type' => $type,
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}
