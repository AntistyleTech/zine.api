<?php

use App\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::get('logout', 'logout');
        Route::get('me', 'me');
    });
