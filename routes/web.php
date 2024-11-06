<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('octane_check', function () {
    return [
        'octane' => ! empty($_SERVER['LARAVEL_OCTANE']),
        'swoole' => (extension_loaded('swoole') || extension_loaded('openswoole')) && app()->bound(\Swoole\Http\Server::class),
        'roadrunner' => ! empty($_SERVER['RR_VERSION']),
        'frankenphp' => ! empty($_SERVER['SERVER_SOFTWARE']) && $_SERVER['SERVER_SOFTWARE'] == 'FrankenPHP',
    ];
});
