<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Global Web Middleware
        |--------------------------------------------------------------------------
        */

        $middleware->web(append: [
            \App\Http\Middleware\SyncGoogleProfile::class,
            \App\Http\Middleware\CheckAccountStatus::class,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Middleware Aliases
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'subscription' => \App\Http\Middleware\EnsureActiveSubscription::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'developer' => \App\Http\Middleware\DeveloperMiddleware::class,
            'not.admin' => \App\Http\Middleware\NotAdmin::class,
            'account.status' => \App\Http\Middleware\CheckAccountStatus::class,
        ]);


        /*
        |--------------------------------------------------------------------------
        | CSRF Exceptions
        |--------------------------------------------------------------------------
        */

        $middleware->validateCsrfTokens(except: [
            'paymongo/webhook',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) =>
                $request->is('api/*') ||
                $request->expectsJson(),
        );

    })
    ->create();