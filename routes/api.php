<?php

use App\Domains\Auth\Http\Controllers\ApiAuthController;
use App\Domains\Task\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'middleware' => ['api']], function () {
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
});

Route::group(['prefix' => '', 'middleware' => ['jsonResponse', 'auth:api',]], function () {
    Route::resource('tasks', TaskController::class)->only(['index', 'store', 'update', 'destroy']);
});
