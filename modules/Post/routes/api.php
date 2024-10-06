<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\PostController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::apiResource('post', PostController::class);

Route::prefix('post')->group(function () {

    Route::controller(PostController::class)
        ->group(function () {
            Route::post('/uploadFile', 'uploadFile');
        });
});
