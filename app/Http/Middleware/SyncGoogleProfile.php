<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncGoogleProfile
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | Only process authenticated users
        |--------------------------------------------------------------------------
        */

        if ($request->user()) {

            $request->user()
                ->queueGoogleProfileSync();

        }

        /*
        |--------------------------------------------------------------------------
        | Continue loading the requested page normally
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}