<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $subscription = $user->subscription;

        if (!$subscription || !$subscription->isActive()) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'You need an active subscription to access premium projects.'
                );
        }

        return $next($request);
    }
}