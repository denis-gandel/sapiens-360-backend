<?php

use App\Http\Middleware\JwtMiddleware;
use App\Modules\Users\Http\Controllers\Concretes\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/by', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);

    Route::get('/me', [UserController::class, 'me'])->middleware(JwtMiddleware::class);

    Route::post('/credentials/verify', [UserController::class, 'verifyCredentials']);
});
