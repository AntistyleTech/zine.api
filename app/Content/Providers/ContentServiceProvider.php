<?php

namespace App\Content\Providers;

use App\Common\Providers\RouteServiceProvider;
use App\Content\Http\Controllers\ContentController;
use App\Content\Http\Controllers\ContentExportController;
use App\Content\Http\Controllers\ExportTargetController;
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
        Route::group(['prefix' => 'api'], function () {

            Route::apiResource('content', ContentController::class);

            Route::apiResource('content/{content}/export', ContentExportController::class)
                ->only(['index', 'store']);

            Route::apiResource('export', ContentExportController::class)
                ->only('index');

            Route::apiResource('target', ExportTargetController::class)
                ->only('index');

        });
    }
}
