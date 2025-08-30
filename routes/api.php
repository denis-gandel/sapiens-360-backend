<?php

use App\Modules\Academics\Http\Controllers\CountryController;
use App\Modules\Academics\Http\Controllers\StateController;
use App\Modules\Users\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{userId}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{userId}', [UserController::class, 'update']);
    Route::delete('/{userId}', [UserController::class, 'destroy']);
    Route::post('/verify-credentials', [UserController::class, 'verifyCredentials']);
});

Route::prefix("academics")->group(function () {
    Route::prefix("countries")->group(function () {
        Route::get('/', [CountryController::class, 'index']);
        Route::get('/{countryId}', [CountryController::class, 'show']);
        Route::post('/', [CountryController::class, 'store']);
        Route::put('/{countryId}', [CountryController::class, 'update']);
        Route::delete('/{countryId}', [CountryController::class, 'destroy']);
    });

    Route::prefix('states')->group(function () {
        Route::get('/', [StateController::class, 'index']);
        Route::get('/{countryId}', [StateController::class, 'getAllByCountry']);
        Route::get('/{stateId}', [StateController::class, 'show']);
        Route::post('/', [StateController::class, 'store']);
        Route::put('/{stateId}', [StateController::class, 'update']);
        Route::delete('/{stateId}', [StateController::class, 'destroy']);
    });
});
