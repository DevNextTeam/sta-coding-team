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

        $users = User::with('subscription')
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

    public function activate(User $user)
    {
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

    public function expire(User $user)
    {
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

    public function extend(User $user)
    {
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
}