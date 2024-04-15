<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Http\Requests\ApiAuthLoginRequest;
use App\Domains\Auth\Http\Requests\ApiAuthRegisterRequest;
use App\Domains\Auth\Services\AuthService;
use App\Helpers\ResponseHelper;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use Illuminate\Routing\Controller;

#[OpenApi\PathItem]
/**
 * @OA\PathItem(path="/api/auth")
 */
class ApiAuthController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register a new user.",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response="201", description="User created successfully."),
     *     @OA\Response(response="400", description="Invalid request data."),
     *     @OA\Response(response="500", description="Internal server error.")
     * )
     */
    public function register(ApiAuthRegisterRequest $request)
    {
        try {
            AuthService::registerUser($request->name, $request->email, $request->password);
            return ResponseHelper::success('User created successfully', null, 201);
        } catch (\Throwable $th) {

            return ResponseHelper::error($th->getMessage(), null, $th->getCode());
        }
    }


    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Log in a user.",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Token generated successfully."),
     *     @OA\Response(response="401", description="Invalid credentials."),
     *     @OA\Response(response="500", description="Internal server error.")
     * )
     */
    #[OpenApi\Operation]
    public function login(ApiAuthLoginRequest $request)
    {
        try {
            return ResponseHelper::success(
                null,
                AuthService::loginUser(
                    $request->email,
                    $request->password
                ),
                200
            );
        } catch (\Throwable $th) {
            return ResponseHelper::error($th->getMessage(), null, $th->getCode());
        }
    }

    /**
     * Logs out the user and returns a success response with a null data payload and the result of the logout operation.
     *
     * @throws \Throwable if an error occurs during the logout process.
     * @return \Illuminate\Http\JsonResponse the success response with a null data payload and the result of the logout operation.
     */
    #[OpenApi\Operation]
    public function logout()
    {
        try {
            return ResponseHelper::success(null, AuthService::logout(), 204);
        } catch (\Throwable $th) {
            return ResponseHelper::error($th->getMessage(), null, $th->getCode());
        }
    }

    /**
     * Refreshes the authentication token and returns a success response with the new token or an error message.
     *
     * @throws \Throwable if an error occurs during the token refresh process.
     * @return \Illuminate\Http\JsonResponse the success response with the new token or an error message.
     */
    #[OpenApi\Operation]
    public function refresh()
    {
        try {
            return ResponseHelper::success(null, AuthService::refresh());
        } catch (\Throwable $th) {
            return ResponseHelper::error($th->getMessage(), null, $th->getCode());
        }
    }
}
