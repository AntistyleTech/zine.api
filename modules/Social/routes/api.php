<?php

use Illuminate\Support\Facades\Route;
use Modules\Social\Http\Controllers\GithubController;
use Modules\Social\Http\Controllers\SocialController;
use Modules\Social\Http\Controllers\TumblrController;

Route::prefix('social')->group(function () {

    Route::apiResource('', SocialController::class)
        ->only('index');

    Route::group([
        'prefix' => 'tumblr',
        'controller' => TumblrController::class
    ], function () {
        Route::get('auth', 'auth');
        Route::get('auth_confirmed', 'authConfirmed');
        Route::get('user', 'user');
    });

//    Route::group([
//        'prefix' => 'github',
//        'controller' => GithubController::class
//    ], function () {
//        Route::get('auth', 'auth');
//        Route::get('auth_confirmed', 'authConfirmed');
//        Route::get('user', 'user');
//    });

});
