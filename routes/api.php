<?php

use App\Http\Middleware\JwtMiddleware;
use App\Modules\Authentication\Http\Controllers\Concretes\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
});

Route::middleware('api')->group(base_path('routes/users.php'));
Route::middleware('api')->group(base_path('routes/academics.php'));
Route::middleware('api')->group(base_path('routes/courses.php'));
Route::middleware('api')->group(base_path('routes/authorization.php'));
