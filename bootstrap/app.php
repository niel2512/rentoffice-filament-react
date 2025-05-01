<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the middleware for API key checking
        // This middleware checks if the API key is present in the request header
        // and if it is valid by checking against the database
        // If the API key is not present or invalid, it returns a 401 Unauthorized response
        $middleware->alias([
            'api_key' => App\Http\Middleware\CheckApiKey::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
