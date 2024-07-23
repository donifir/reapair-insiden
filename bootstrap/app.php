<?php

use App\Http\Middleware\SanctumMiddleware;
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
        //
        // $middleware->append(SanctumMiddleware::class);
        // AdminMiddleware' =>[ \App\Http\Middleware\AdminMiddleware::class,],
        $middleware->web(append: [
            SanctumMiddleware::class,
        ]);
  
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
