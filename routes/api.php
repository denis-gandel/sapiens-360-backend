<?php

use App\Modules\Academics\Http\Controllers\Concretes\CityController;
use App\Modules\Academics\Http\Controllers\Concretes\CountryController;
use App\Modules\Academics\Http\Controllers\Concretes\DistrictController;
use App\Modules\Academics\Http\Controllers\Concretes\InstituteController;
use App\Modules\Academics\Http\Controllers\Concretes\NatureController;
use App\Modules\Academics\Http\Controllers\Concretes\PeriodController;
use App\Modules\Academics\Http\Controllers\Concretes\StateController;
use App\Modules\Academics\Http\Controllers\Concretes\TypeController;
use App\Modules\Authorization\Http\Controllers\Concretes\CategoryController;
use App\Modules\Authorization\Http\Controllers\Concretes\PermissionController;
use App\Modules\Authorization\Http\Controllers\Concretes\RoleController;
use App\Modules\Authorization\Http\Controllers\Concretes\RolePermissionsController;
use App\Modules\Courses\Http\Controllers\Concretes\CourseController;
use App\Modules\Courses\Http\Controllers\Concretes\LevelController;
use App\Modules\Courses\Http\Controllers\Concretes\ProgramController;
use App\Modules\Courses\Http\Controllers\Concretes\SubjectController;
use App\Modules\Users\Http\Controllers\Concretes\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/by', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);

    Route::post('/credentials/verify', [UserController::class, 'verifyCredentials']);
});

Route::prefix("academics")->group(function () {
    Route::prefix("countries")->group(function () {
        Route::get('/', [CountryController::class, 'index']);
        Route::get('/by', [CountryController::class, 'show']);
        Route::post('/', [CountryController::class, 'store']);
        Route::put('/{id}', [CountryController::class, 'update']);
        Route::delete('/{id}', [CountryController::class, 'destroy']);
    });

    Route::prefix('states')->group(function () {
        Route::get('/', [StateController::class, 'index']);
        Route::get('/by', [StateController::class, 'show']);
        Route::post('/', [StateController::class, 'store']);
        Route::put('/{id}', [StateController::class, 'update']);
        Route::delete('/{id}', [StateController::class, 'destroy']);
    });

    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index']);
        Route::get('/by', [CityController::class, 'show']);
        Route::post('/', [CityController::class, 'store']);
        Route::put('/{id}', [CityController::class, 'update']);
        Route::delete('/{id}', [CityController::class, 'destroy']);
    });

    Route::prefix('districts')->group(function () {
        Route::get('/', [DistrictController::class, 'index']);
        Route::get('/by', [DistrictController::class, 'show']);
        Route::post('/', [DistrictController::class, 'store']);
        Route::put('/{id}', [DistrictController::class, 'update']);
        Route::delete('/{id}', [DistrictController::class, 'destroy']);
    });

    Route::prefix('types')->group(function () {
        Route::get('/', [TypeController::class, 'index']);
        Route::get('/by', [TypeController::class, 'show']);
        Route::post('/', [TypeController::class, 'store']);
        Route::put('/{id}', [TypeController::class, 'update']);
        Route::delete('/{id}', [TypeController::class, 'destroy']);
    });

    Route::prefix('natures')->group(function () {
        Route::get('/', [NatureController::class, 'index']);
        Route::get('/by', [NatureController::class, 'show']);
        Route::post('/', [NatureController::class, 'store']);
        Route::put('/{id}', [NatureController::class, 'update']);
        Route::delete('/{id}', [NatureController::class, 'destroy']);
    });

    Route::prefix('periods')->group(function () {
        Route::get('/', [PeriodController::class, 'index']);
        Route::get('/by', [PeriodController::class, 'show']);
        Route::post('/', [PeriodController::class, 'store']);
        Route::put('/{id}', [PeriodController::class, 'update']);
        Route::delete('/{id}', [PeriodController::class, 'destroy']);
    });

    Route::prefix('institutes')->group(function () {
        Route::get('/', [InstituteController::class, 'index']);
        Route::get('/by', [InstituteController::class, 'show']);
        Route::post('/', [InstituteController::class, 'store']);
        Route::put('/{id}', [InstituteController::class, 'update']);
        Route::delete('/{id}', [InstituteController::class, 'destroy']);
    });
});

Route::prefix("courses")->group(function () {
    Route::prefix("programs")->group(function () {
        Route::get('/', [ProgramController::class, 'index']);
        Route::get('/by', [ProgramController::class, 'show']);
        Route::post('/', [ProgramController::class, 'store']);
        Route::put('/{id}', [ProgramController::class, 'update']);
        Route::delete('/{id}', [ProgramController::class, 'destroy']);
    });

    Route::prefix('levels')->group(function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::get('/by', [LevelController::class, 'show']);
        Route::post('/', [LevelController::class, 'store']);
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::delete('/{id}', [LevelController::class, 'destroy']);
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/by', [CourseController::class, 'show']);
        Route::post('/', [CourseController::class, 'store']);
        Route::put('/{id}', [CourseController::class, 'update']);
        Route::delete('/{id}', [CourseController::class, 'destroy']);

        Route::get('/{id}/subjects', [CourseController::class, 'getSubjects']);
    });

    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index']);
        Route::get('/by', [SubjectController::class, 'show']);
        Route::post('/', [SubjectController::class, 'store']);
        Route::put('/{id}', [SubjectController::class, 'update']);
        Route::delete('/{id}', [SubjectController::class, 'destroy']);
    });
});

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
