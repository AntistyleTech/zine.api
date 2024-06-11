<?php

use Illuminate\Support\Facades\Route;
use Modules\Social\Http\Controllers\SocialController;
use Modules\Social\Http\Controllers\TumblrController;

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

Route::apiResource('social', SocialController::class)->only('index');

Route::get('tumblr/test', [TumblrController::class, 'test']);
