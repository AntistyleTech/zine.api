<?php

namespace App\Category\Providers;

use App\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes();
    }

    private function routes(): void
    {
        Route::apiResource('category', CategoryController::class)
            ->only('index');
    }
}
