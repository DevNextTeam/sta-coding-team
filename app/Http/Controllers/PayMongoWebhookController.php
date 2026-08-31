<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayMongoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Verify PayMongo Webhook Signature
        |--------------------------------------------------------------------------
        */

        $signatureHeader = $request->header('Paymongo-Signature');
        $webhookSecret = config('services.paymongo.webhook_secret');

        if (!$signatureHeader || !$webhookSecret) {
            Log::warning('PayMongo webhook: Missing signature or webhook secret.');

            return response()->json([
                'message' => 'Invalid webhook configuration.',
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Parse Signature
        |--------------------------------------------------------------------------
        */

        $parts = [];

        foreach (explode(',', $signatureHeader) as $part) {
            [$key, $value] = array_pad(explode('=', $part, 2), 2, null);

            if ($key && $value) {
                $parts[$key] = $value;
            }
        }

        $timestamp = $parts['t'] ?? null;

        // Test mode uses "te"
        // Live mode uses "li"
        $providedSignature = $parts['te'] ?? $parts['li'] ?? null;

        if (!$timestamp || !$providedSignature) {
            Log::warning('PayMongo webhook: Invalid signature header.');

            return response()->json([
                'message' => 'Invalid signature.',
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Expected Signature
        |--------------------------------------------------------------------------
        */

        $rawPayload = $request->getContent();

        $signature = hash_hmac(
            'sha256',
            $timestamp . '.' . $rawPayload,
            $webhookSecret
        );

        /*
        |--------------------------------------------------------------------------
        | Compare Signatures
        |--------------------------------------------------------------------------
        */

        if (!hash_equals($signature, $providedSignature)) {
            Log::warning('PayMongo webhook: Signature verification failed.');

            return response()->json([
                'message' => 'Invalid signature.',
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Parse Payload
        |--------------------------------------------------------------------------
        */

        $payload = json_decode($rawPayload, true);

        if (!is_array($payload)) {
            Log::warning('PayMongo webhook: Invalid JSON payload.');

            return response()->json([
                'message' => 'Invalid payload.',
            ], 400);
        }

        Log::info('PayMongo Webhook Received', $payload);

        /*
        |--------------------------------------------------------------------------
        | Get Event Type
        |--------------------------------------------------------------------------
        */

        $eventType = data_get(
            $payload,
            'data.attributes.type'
        );

        /*
        |--------------------------------------------------------------------------
        | Ignore Events We Don't Need
        |--------------------------------------------------------------------------
        */

        if ($eventType !== 'checkout_session.payment.paid') {
            return response()->json([
                'message' => 'Event ignored.',
                'event_type' => $eventType,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Get Checkout Session ID
        |--------------------------------------------------------------------------
        */

        $checkoutSessionId = data_get(
            $payload,
            'data.attributes.data.id'
        );

        if (!$checkoutSessionId) {
            Log::warning(
                'PayMongo webhook: Checkout Session ID missing.'
            );

            return response()->json([
                'message' => 'Checkout session ID missing.',
            ], 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Find Subscription
        |--------------------------------------------------------------------------
        */

        $subscription = Subscription::where(
            'paymongo_checkout_session_id',
            $checkoutSessionId
        )->first();

        if (!$subscription) {
            Log::warning(
                'PayMongo webhook: Subscription not found.',
                [
                    'checkout_session_id' => $checkoutSessionId,
                ]
            );

            return response()->json([
                'message' => 'Subscription not found.',
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Activation
        |--------------------------------------------------------------------------
        */

        if ($subscription->status === 'active') {
            return response()->json([
                'message' => 'Subscription already active.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Activate Subscription
        |--------------------------------------------------------------------------
        */

        $subscription->update([
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
        ]);

        Log::info(
            'PayMongo subscription activated.',
            [
                'subscription_id' => $subscription->id,
                'checkout_session_id' => $checkoutSessionId,
            ]
        );

        return response()->json([
            'message' => 'Subscription activated successfully.',
        ]);
    }
}