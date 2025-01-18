<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\CustomThrottleRequest;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]); 
        $middleware->trustHosts(at: ['demo_app.test']);
        // $middleware->trustHosts(at: ['laravel.test'], subdomains: false);

        $middleware->alias([
            'limited_request' => CustomThrottleRequest::class
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
