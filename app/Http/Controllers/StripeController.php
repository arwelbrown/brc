<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Session as Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function index()
    {
        return view('payments');
    }

    public function checkout()
    {
        $data = Session::get('data');

        Stripe::setApiKey(config('stripe.sk'));

        $session = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $data['product_name'] . ' - Physical Copies',
                        ],
                        'unit_amount' => (int) env('PHYSICAL_ORDER_PRICE') * 100,
                    ],
                    'quantity' => $data['quantity'],
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment_success'),
            'cancel_url' => route('payment_index'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return view('payments');
    }
}
