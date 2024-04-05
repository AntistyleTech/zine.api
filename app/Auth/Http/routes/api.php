<?php

use App\Auth\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => '/auth', 'controller' => AuthController::class],
    function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::get('me', 'me');
    }
);

//Route::post('/login', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
