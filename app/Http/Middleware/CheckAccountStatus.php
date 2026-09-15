<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | Blocked Account Page
        |--------------------------------------------------------------------------
        |
        | Suspended and banned users must be allowed to access the blocked
        | account page. Otherwise, the middleware would redirect the user
        | back to the same page forever and cause ERR_TOO_MANY_REDIRECTS.
        |
        */

        if ($request->routeIs('account.blocked')) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Guest
        |--------------------------------------------------------------------------
        |
        | Users who are not logged in are allowed to continue normally.
        |
        */

        $user = $request->user();

        if (!$user) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Admin / Developer
        |--------------------------------------------------------------------------
        |
        | Admins and Developers have permanent full access.
        | They are never blocked by account restrictions.
        |
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Allow Logout
        |--------------------------------------------------------------------------
        |
        | A suspended or banned user must still be able to log out.
        |
        */

        if ($request->routeIs('logout')) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Temporary Suspension / Ban Expired
        |--------------------------------------------------------------------------
        |
        | If a temporary restriction has expired, automatically restore
        | the account to active status.
        |
        */

        if (
            $user->status !== 'active' &&
            $user->status_until &&
            $user->status_until->isPast()
        ) {
            $user->update([
                'status' => 'active',
                'status_until' => null,
            ]);

            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Suspended Account
        |--------------------------------------------------------------------------
        |
        | The user can remain logged in, but cannot access the website.
        | They are redirected to the blocked account page.
        |
        */

        if ($user->isSuspended()) {
            return redirect()
                ->route('account.blocked')
                ->with('blocked_type', 'suspended');
        }


        /*
        |--------------------------------------------------------------------------
        | Banned Account
        |--------------------------------------------------------------------------
        |
        | Permanent bans have a null status_until.
        | Temporary bans have a future status_until.
        |
        */

        if ($user->isBanned()) {
            return redirect()
                ->route('account.blocked')
                ->with('blocked_type', 'banned');
        }


        /*
        |--------------------------------------------------------------------------
        | Normal Account
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}