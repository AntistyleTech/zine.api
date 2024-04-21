<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => ['message' => 'pong']);

// All routes registered via ServiceProviders
