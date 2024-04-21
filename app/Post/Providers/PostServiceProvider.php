<?php

namespace App\Post\Providers;

use App\Post\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->routes();
    }

    private function routes(): void
    {
        Route::apiResource('api/post', PostController::class);
    }
}
