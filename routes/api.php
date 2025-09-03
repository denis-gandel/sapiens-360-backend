<?php

use App\Http\Middleware\JwtMiddleware;
use App\Modules\Authentication\Http\Controllers\Concretes\AuthenticationController;
use App\Modules\Authorization\Http\Controllers\Concretes\RolePermissionsController;
use App\Modules\Users\Http\Controllers\Concretes\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::middleware(JwtMiddleware::class)->get('/me', [UserController::class, 'me']);
    Route::prefix('role-permissions')->group(function () {
        Route::get('/', [RolePermissionsController::class, 'index']);
        Route::get('/by', [RolePermissionsController::class, 'show']);
        Route::post('/', [RolePermissionsController::class, 'store']);
        Route::put('/{id}', [RolePermissionsController::class, 'update']);
        Route::delete('/{id}', [RolePermissionsController::class, 'destroy']);

        Route::post('/initialize/{tenantId}', [RolePermissionsController::class, 'initialize']);
        Route::get('/role/{id}/permissions', [RolePermissionsController::class, 'getPermissionsByRole']);
    });
});

Route::middleware(JwtMiddleware::class)->group(base_path('routes/academics.php'));
Route::middleware(JwtMiddleware::class)->group(base_path('routes/authorization.php'));
Route::middleware(JwtMiddleware::class)->group(base_path('routes/courses.php'));
Route::middleware(JwtMiddleware::class)->group(base_path('routes/users.php'));
