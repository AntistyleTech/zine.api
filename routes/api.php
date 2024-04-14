<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => [
    'success' => true,
    'data' => 'pong',
    env('DB_CONNECTION')
]);

// check existing api.php in each module folder by path Module/Http/routes/api.php
foreach (new DirectoryIterator(base_path('/app')) as $item) {
    if ($item->isDir() && !$item->isDot()) {
        $routesPath = $item->getPathname().'/Http/routes/api.php';
        if (file_exists($routesPath)) {
            require $routesPath;
        }
    }
}

