<?php

namespace App\Hooks;

use UnexpectedValueException;
use Stripe\Event;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;

require_once '../vendor/autoload.php';

Stripe::setApiKey(config('stripe.sk'));
// Replace this endpoint secret with your endpoint's unique secret
// If you are testing with the CLI, find the secret by running 'stripe listen'
// If you are using an endpoint defined with the API or dashboard, look in your webhook settings
// at https://dashboard.stripe.com/webhooks
$endpoint_secret = 'whsec_513f325da68b0d6ae5657b096a688ce06a5b8c4d2692655471bca8b2368ced03';

$payload = file_get_contents('php://input');
$event = null;

try {
    $event = Event::constructFrom(json_decode($payload, true));
} catch(UnexpectedValueException $e) {
    // Invalid payload
    echo '⚠️  Webhook error while parsing basic request.';
    http_response_code(400);
    exit();
}
if ($endpoint_secret) {
    // Only verify the event if there is an endpoint secret defined
    // Otherwise use the basic decoded event
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    try {
        $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
    } catch(SignatureVerificationException $e) {
        // Invalid signature
        echo '⚠️  Webhook error while validating signature.';
        http_response_code(400);
        exit();
    }
}

// Handle the event
switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
        // Then define and call a method to handle the successful payment intent.
        // handlePaymentIntentSucceeded($paymentIntent);
        break;
    case 'payment_method.attached':
        $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
        // Then define and call a method to handle the successful attachment of a PaymentMethod.
        // handlePaymentMethodAttached($paymentMethod);
        break;
    default:
    // Unexpected event type
    error_log('Received unknown event type');
}

http_response_code(200);