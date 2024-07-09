<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event['type']) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event['data']['object'];
                // 支払い成功時の処理
                Log::info('Payment succeeded: ' . $paymentIntent['id']);
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event['data']['object'];
                // 支払い失敗時の処理
                Log::info('Payment failed: ' . $paymentIntent['id']);
                break;
            default:
                return response()->json(['error' => 'Unhandled event type'], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }
}
