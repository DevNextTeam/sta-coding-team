<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        /*
         * Guests are allowed to continue normally.
         */
        if (!$user) {
            return $next($request);
        }

        /*
         * Admins and Developers always have full access.
         */
        if (in_array($user->role, ['admin', 'developer'])) {
            return $next($request);
        }

        /*
         * If a temporary suspension or ban has expired,
         * automatically restore the account.
         */
        if (
            $user->status !== 'active'
            && $user->status_until
            && $user->status_until->isPast()
        ) {
            $user->update([
                'status' => 'active',
                'status_until' => null,
            ]);

            return $next($request);
        }

        /*
         * Block banned users.
         */
        if ($user->isBanned()) {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Your account has been banned.'
                );
        }

        /*
         * Block suspended users.
         */
        if ($user->isSuspended()) {
            auth()->logout();

            $message = $user->status_until
                ? 'Your account is suspended until '
                    . $user->status_until->format('M d, Y h:i A')
                    . '.'
                : 'Your account is currently suspended.';

            return redirect()
                ->route('login')
                ->with('error', $message);
        }

        /*
         * Account is active.
         */
        return $next($request);
    }
}