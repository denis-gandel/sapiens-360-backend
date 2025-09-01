<?php

use App\Modules\Courses\Http\Controllers\Concretes\CourseController;
use App\Modules\Courses\Http\Controllers\Concretes\LevelController;
use App\Modules\Courses\Http\Controllers\Concretes\ProgramController;
use App\Modules\Courses\Http\Controllers\Concretes\SubjectController;
use Illuminate\Support\Facades\Route;

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
