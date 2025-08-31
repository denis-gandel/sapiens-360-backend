<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to Sapiens 360 - Backend', 'status' => 'success', 'author' => 'Denis Jorge Gandarillas Delgado', 'version' => '1.0.0']);
});
