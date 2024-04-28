<?php

namespace App\Content\Providers;

use App\Content\Http\Controllers\ContentExportController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider implements RouteServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->routes();
    }

    public function routes(): void
    {
        Route::group(['prefix' => 'api/content'], function () {
            Route::apiResource('api/post', ContentController::class);
            Route::controller(ContentExportController::class)
                ->prefix('export')
                ->group(function () {
                    Route::get('/target');
                    Route::post('', 'store');
                });
        });
    }
}
