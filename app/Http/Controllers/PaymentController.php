<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function checkout()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Check Existing Subscription
        |--------------------------------------------------------------------------
        */

        $subscription = $user->subscription;

        if ($subscription && $subscription->isActive()) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'You already have an active subscription.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create PayMongo Checkout Session
        |--------------------------------------------------------------------------
        */

        $response = Http::withBasicAuth(
            config('services.paymongo.secret_key'),
            ''
        )->post('https://api.paymongo.com/v1/checkout_sessions', [

            'data' => [
                'attributes' => [

                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => 9900,
                            'name' => 'DevNext Monthly Subscription',
                            'quantity' => 1,
                        ],
                    ],

                    'payment_method_types' => [
                        'card',
                        'gcash',
                        'grab_pay',
                        'paymaya',
                    ],

                    'success_url' => route('payment.success'),
                    'cancel_url' => route('payment.cancel'),

                    'description' => 'DevNext Premium Monthly Subscription',

                    'send_email_receipt' => false,

                    'billing' => [
                        'name' => $user->name,
                        'email' => $user->email,
                    ],

                ],
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Check PayMongo Response
        |--------------------------------------------------------------------------
        */

        if ($response->failed()) {

            return back()->with(
                'error',
                'Unable to create payment session. Please try again.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Get PayMongo Checkout Information
        |--------------------------------------------------------------------------
        */

        $checkoutSessionId = $response->json(
            'data.id'
        );

        $checkoutUrl = $response->json(
            'data.attributes.checkout_url'
        );

        /*
        |--------------------------------------------------------------------------
        | Create / Update Pending Subscription
        |--------------------------------------------------------------------------
        */

        if ($subscription) {

            $subscription->update([
                'status' => 'pending',
                'starts_at' => null,
                'ends_at' => null,
                'paymongo_checkout_session_id' => $checkoutSessionId,
            ]);

        } else {

            $user->subscription()->create([
                'status' => 'pending',
                'starts_at' => null,
                'ends_at' => null,
                'paymongo_checkout_session_id' => $checkoutSessionId,
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Redirect User To PayMongo
        |--------------------------------------------------------------------------
        */

        return redirect()->away($checkoutUrl);
    }


    /*
    |--------------------------------------------------------------------------
    | Payment Success
    |--------------------------------------------------------------------------
    */

    public function success()
    {
        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Payment completed. Your subscription will be activated after payment confirmation.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Payment Cancelled
    |--------------------------------------------------------------------------
    */

    public function cancel()
    {
        return redirect()
            ->route('dashboard')
            ->with(
                'error',
                'Payment was cancelled.'
            );
    }
}