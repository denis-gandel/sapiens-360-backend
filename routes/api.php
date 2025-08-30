<?php

use App\Modules\Users\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{userId}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{userId}', [UserController::class, 'update']);
    Route::delete('/{userId}', [UserController::class, 'destroy']);
});
