<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Middleware\ValidateTokenMiddleware;

Route::prefix('users')->group(function() {
    Route::post('/', [UserController::class, 'store'])->middleware(ValidateTokenMiddleware::class);
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
});

Route::get('token', [TokenController::class, 'generateToken']);
