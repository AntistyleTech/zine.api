<?php

declare(strict_types=1);

namespace App\Providers;

/**
 * Call ServiceProvider::routes() on ServiceProvider::boot()
 */
interface RouteServiceProvider
{
    public function boot(): void;

    /**
     * Register routes
     */
    public function routes(): void;
}
