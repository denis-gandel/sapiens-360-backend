<?php

use App\Modules\Authentication\Http\Controllers\Concretes\AuthenticationController;
use App\Modules\Authorization\Http\Controllers\Concretes\RolePermissionsController;
use App\Modules\Users\Http\Controllers\Concretes\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/me', [UserController::class, 'me']);
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

require_once base_path('routes/academics.php');
require_once base_path('routes/authorization.php');
require_once base_path('routes/courses.php');
require_once base_path('routes/users.php');
