<?php

use App\Http\Middleware\JwtMiddleware;
use App\Modules\Authentication\Http\Controllers\Concretes\AuthenticationController;
use App\Modules\Authorization\Http\Controllers\Concretes\RolePermissionsController;
use App\Modules\Users\Http\Controllers\Concretes\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::middleware('api')->get('/me', [UserController::class, 'me']);
    Route::post('/role-permissions/initialize/{tenantId}', [RolePermissionsController::class, 'initialize']);
});

Route::middleware('api')->group(base_path('routes/academics.php'));
Route::middleware('api')->group(base_path('routes/authorization.php'));
Route::middleware('api')->group(base_path('routes/courses.php'));
Route::middleware('api')->group(base_path('routes/users.php'));
