<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');

        /*
        |--------------------------------------------------------------------------
        | Manage Regular Users Only
        |--------------------------------------------------------------------------
        |
        | Admin and Developer accounts are excluded from user management.
        |
        */

        $users = User::with('subscription')
            ->where('role', 'user')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($status !== 'all', function ($query) use ($status) {

                if ($status === 'none') {

                    $query->whereDoesntHave('subscription');

                } elseif ($status === 'active') {

                    $query->whereHas('subscription', function ($query) {
                        $query->where('status', 'active')
                            ->where('ends_at', '>', now());
                    });

                } elseif ($status === 'pending') {

                    $query->whereHas('subscription', function ($query) {
                        $query->where('status', 'pending');
                    });

                } elseif ($status === 'expired') {

                    $query->whereHas('subscription', function ($query) {
                        $query->where(function ($query) {
                            $query->where('status', 'expired')
                                ->orWhere(function ($query) {
                                    $query->where('status', 'active')
                                        ->where('ends_at', '<=', now());
                                });
                        });
                    });
                }

            })
            ->latest()
            ->get();

        return view('admin.users.index', compact(
            'users',
            'search',
            'status'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Activate Subscription
    |--------------------------------------------------------------------------
    */

    public function activate(User $user)
    {
        /*
        | Admin and Developer accounts have permanent access.
        | They should never be given or modified through
        | regular subscription management.
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return back()->with(
                'error',
                'Admin and Developer accounts have permanent premium access.'
            );
        }

        $subscription = $user->subscription()->firstOrNew();

        $subscription->status = 'active';
        $subscription->starts_at = now();
        $subscription->ends_at = now()->addMonth();

        $subscription->save();

        return back()->with(
            'success',
            "{$user->name}'s subscription has been activated."
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Expire Subscription
    |--------------------------------------------------------------------------
    */

    public function expire(User $user)
    {
        /*
        | Admin and Developer accounts have permanent access.
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return back()->with(
                'error',
                'Admin and Developer accounts have permanent premium access.'
            );
        }

        if ($user->subscription) {
            $user->subscription->update([
                'status' => 'expired',
                'ends_at' => now(),
            ]);
        }

        return back()->with(
            'success',
            "{$user->name}'s subscription has been expired."
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Extend Subscription
    |--------------------------------------------------------------------------
    */

    public function extend(User $user)
    {
        /*
        | Admin and Developer accounts have permanent access.
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return back()->with(
                'error',
                'Admin and Developer accounts have permanent premium access.'
            );
        }

        $subscription = $user->subscription;

        if (!$subscription) {

            $subscription = $user->subscription()->create([
                'status' => 'active',
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
            ]);

        } else {

            $startFrom = $subscription->ends_at && $subscription->ends_at->isFuture()
                ? $subscription->ends_at
                : now();

            $subscription->update([
                'status' => 'active',
                'ends_at' => $startFrom->copy()->addMonth(),
            ]);
        }

        return back()->with(
            'success',
            "{$user->name}'s subscription has been extended by 1 month."
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Suspend User
    |--------------------------------------------------------------------------
    */

    public function suspend(Request $request, User $user)
    {
        /*
        | Admin and Developer accounts cannot be suspended.
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return back()->with(
                'error',
                'Admin and Developer accounts cannot be suspended.'
            );
        }

        /*
        | Extra protection:
        | Only regular users can be suspended here.
        */

        if ($user->role !== 'user') {
            return back()->with(
                'error',
                'This account cannot be suspended from User Management.'
            );
        }

        /*
        | Validate suspension duration.
        |
        | Duration is measured in days.
        */

        $validated = $request->validate([
            'duration' => [
                'required',
                'integer',
                'min:1',
                'max:3650',
            ],
        ]);

        $duration = (int) $validated['duration'];

        $user->update([
            'status' => 'suspended',
            'status_until' => now()->addDays($duration),
        ]);

        return back()->with(
            'success',
            "{$user->name}'s account has been suspended for {$duration} "
            . ($duration === 1 ? 'day.' : 'days.')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Ban User
    |--------------------------------------------------------------------------
    */

    public function ban(Request $request, User $user)
    {
        /*
        | Admin and Developer accounts cannot be banned.
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return back()->with(
                'error',
                'Admin and Developer accounts cannot be banned.'
            );
        }

        /*
        | Extra protection:
        | Only regular users can be banned here.
        */

        if ($user->role !== 'user') {
            return back()->with(
                'error',
                'This account cannot be banned from User Management.'
            );
        }

        /*
        | Validate ban duration.
        |
        | "permanent" means status_until will remain null.
        */

        $validated = $request->validate([
            'duration' => [
                'required',
                'in:7,30,90,365,permanent',
            ],
        ]);

        if ($validated['duration'] === 'permanent') {

            $user->update([
                'status' => 'banned',
                'status_until' => null,
            ]);

            return back()->with(
                'success',
                "{$user->name}'s account has been permanently banned."
            );
        }

        $duration = (int) $validated['duration'];

        $user->update([
            'status' => 'banned',
            'status_until' => now()->addDays($duration),
        ]);

        return back()->with(
            'success',
            "{$user->name}'s account has been banned for {$duration} "
            . ($duration === 1 ? 'day.' : 'days.')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Unban / Unsuspend User
    |--------------------------------------------------------------------------
    */

    public function unban(User $user)
    {
        /*
        | Admin and Developer accounts should never reach this action.
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return back()->with(
                'error',
                'Admin and Developer accounts do not need to be unbanned.'
            );
        }

        /*
        | Extra protection:
        | Only regular users can be restored here.
        */

        if ($user->role !== 'user') {
            return back()->with(
                'error',
                'This account cannot be restored from User Management.'
            );
        }

        $user->update([
            'status' => 'active',
            'status_until' => null,
        ]);

        return back()->with(
            'success',
            "{$user->name}'s account has been restored."
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete User
    |--------------------------------------------------------------------------
    */

    public function destroy(User $user)
    {
        /*
        | Admin and Developer accounts must never be deleted
        | through regular User Management.
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return back()->with(
                'error',
                'Admin and Developer accounts cannot be deleted from User Management.'
            );
        }

        /*
        | Extra protection:
        | Only regular users should be deleted through this controller.
        */

        if ($user->role !== 'user') {
            return back()->with(
                'error',
                'This account cannot be deleted from User Management.'
            );
        }

        $userName = $user->name;

        /*
        |--------------------------------------------------------------------------
        | Delete Subscription
        |--------------------------------------------------------------------------
        */

        if ($user->subscription) {
            $user->subscription->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Profile
        |--------------------------------------------------------------------------
        */

        if ($user->profile) {
            $user->profile->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | Delete User
        |--------------------------------------------------------------------------
        */

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                "{$userName}'s account has been permanently deleted."
            );
    }
}