<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        $user = Auth::user();

        $subscription = $user->subscription;

        // If the user already has an active subscription,
        // don't create another payment.
        if ($subscription && $subscription->isActive()) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'You already have an active subscription.'
                );
        }

        // All new subscriptions must go through PayMongo.
        return redirect()
            ->route('dashboard')
            ->with(
                'error',
                'Please use the Subscribe Now button to start your subscription.'
            );
    }
}