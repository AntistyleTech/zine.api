<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => 'pong');

Route::name('auth.')
    ->group(base_path('app/Auth/Http/routes/api.php'));

