<?php

use App\Http\Middleware\PermissionMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->register('permission', \App\Http\Middleware\PermissionMiddleware::class);
       $middleware->alias([
        'permission' => \App\Http\Middleware\PermissionMiddleware::class,
       ]);
       $middleware->append(\App\Http\Middleware\AllowedRolesMiddleware::class);

       $middleware->alias([
        'admin' => \App\Http\Middleware\AllowedRolesMiddleware::class,
        'permission' => \App\Http\Middleware\PermissionMiddleware::class,
       ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
