<?php

namespace App\Category\Providers;

use App\Category\Http\Controllers\CategoryController;
use App\Category\Http\Controllers\TagController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider implements RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes();
    }

    public function routes(): void
    {
        Route::apiResource('api/category', CategoryController::class,)
            ->only('index');

        Route::apiResource('api/tag', TagController::class,)
            ->only('index');
    }
}
