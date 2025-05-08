<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployerMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\UserEmployerMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(AdminMiddleware::class);
        // $middleware->alias('admin', AdminMiddleware::class);
         // define your named (route-only) middleware
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'employer' => \App\Http\Middleware\EmployerMiddleware::class,
        'user' => \App\Http\Middleware\UserMiddleware::class,
        'useremployer' => \App\Http\Middleware\UserEmployerMiddleware::class,
    ]);

    // if you also want it to run *globally*, you can append it:
    // $middleware->append([
    //     \App\Http\Middleware\AdminMiddleware::class,
    // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
