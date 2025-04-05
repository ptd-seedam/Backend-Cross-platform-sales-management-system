<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\Integration\IntegrationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

Route::middleware(['auth:api'])->group(function () {

    Route::get('/integrations', [IntegrationController::class, 'index']);
    Route::post('/integrations/connect', [IntegrationController::class, 'store']);
    Route::delete('/integrations/{id}', [IntegrationController::class, 'destroy']);

    // user
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});
