<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\CustomThrottleRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;



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
        // $exceptions->respond(function (Response $response) {
        //     $statusCode = $response->getStatusCode();
        //     if (in_array($statusCode, [400, 401, 403, 404, 408, 422, 426, 429, 500, 502, 503, 504, 405])) {
        //         return Inertia::render('Components/errorsPage', [
        //             'statusCode' => $statusCode
        //         ]);
        //     }

        //     return $response;
        // });
    })->create();
