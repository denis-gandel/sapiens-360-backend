<?php

use App\Modules\Authorization\Http\Controllers\Concretes\CategoryController;
use App\Modules\Authorization\Http\Controllers\Concretes\PermissionController;
use App\Modules\Authorization\Http\Controllers\Concretes\RoleController;
use App\Modules\Authorization\Http\Controllers\Concretes\RolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::prefix("authorization")->group(function () {
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/by', [RoleController::class, 'show']);
        Route::post('/', [RoleController::class, 'store']);
        Route::put('/{id}', [RoleController::class, 'update']);
        Route::delete('/{id}', [RoleController::class, 'destroy']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/by', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index']);
        Route::get('/by', [PermissionController::class, 'show']);
        Route::post('/', [PermissionController::class, 'store']);
        Route::put('/{id}', [PermissionController::class, 'update']);
        Route::delete('/{id}', [PermissionController::class, 'destroy']);
    });

    Route::prefix('role-permissions')->group(function () {
        Route::get('/', [RolePermissionsController::class, 'index']);
        Route::get('/by', [RolePermissionsController::class, 'show']);
        Route::post('/', [RolePermissionsController::class, 'store']);
        Route::put('/{id}', [RolePermissionsController::class, 'update']);
        Route::delete('/{id}', [RolePermissionsController::class, 'destroy']);

        Route::get('/role/{id}/permissions', [RolePermissionsController::class, 'getPermissionsByRole']);
        Route::post('/initialize/{tenantId}', [RolePermissionsController::class, 'initialize']);
    });
});
