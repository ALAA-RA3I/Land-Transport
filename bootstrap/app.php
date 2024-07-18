<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
      /*  web: __DIR__.'/../routes/manager.php',
        api: __DIR__.'/../routes/api.php',*/
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('api')
                ->prefix('user')
                ->group(base_path('routes/user.php'));
            Route::middleware('web')
                ->prefix('manager')
                ->group(base_path('routes/manager.php'));
            Route::middleware('api')
                ->prefix('driver')
                ->group(base_path('routes/driver.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
