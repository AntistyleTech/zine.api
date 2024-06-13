<?php

namespace App\Social\Providers;

use App\Providers\RouteServiceProvider;
use App\Social\Http\Controllers\TestController;
use App\Social\Http\Controllers\TumblrController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SocialServiceProvider extends ServiceProvider implements RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes();
    }

    public function routes(): void
    {
        Route::apiResource('api/social', TestController::class,)
            ->only('index');

        Route::group([
            'prefix' => 'api/social/tumblr',
            'controller' => TumblrController::class
        ], function () {
            Route::get('auth', 'auth');
            Route::get('auth_confirmed', 'authConfirmed');
            Route::get('user', 'getUserInfo');
            Route::get('send', 'sendPost');
        });

        Route::get('api/social/test', [TumblrController::class, 'index']);

    }
}
