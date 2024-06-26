<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('logout', 'logout');
        Route::get('me', 'user');
    });
