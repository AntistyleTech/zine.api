<?php

namespace App;

use DirectoryIterator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->searchAppProviders() as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Search service providers by path
     * App/{Module}/Providers/{Module}ServiceProvider.php
     *
     * @return <class-string>[]
     */
    private function searchAppProviders(): array
    {
        /** @var DirectoryIterator $item */
        foreach (new DirectoryIterator(base_path('/app')) as $item) {
            if ($item->isDir() && !$item->isDot()) {

                $path = $item->getPathname();
                $name = $item->getFilename();

                $providerPath = "{$path}/Providers/{$name}ServiceProvider.php";
                $providerClass = "App\\{$name}\\Providers\\{$name}ServiceProvider";

                if (file_exists($providerPath)) {
                    $providers[] = $providerClass;
                }
            }
        }

        return $providers ?? [];
    }
}
