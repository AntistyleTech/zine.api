<?php

namespace App\Post\Providers;

use App\Post\Http\Controllers\PostController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider implements RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes();
    }

    public function routes(): void
    {
        Route::apiResource('api/post', PostController::class);
    }
}
