<?php

declare(strict_types=1);

namespace App\Auth\Providers;

use App\Auth\Http\Controllers\AuthController;
use App\Common\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class AuthServiceProvider extends ServiceProvider implements RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes();
    }

    public function routes(): void
    {
        Route::controller(AuthController::class)
            ->prefix('api/auth')
            ->group(function () {
                Route::post('register', 'register');
                Route::post('login', 'login');
                Route::post('logout', 'logout');
                Route::get('me', 'me');
            });
    }
}
