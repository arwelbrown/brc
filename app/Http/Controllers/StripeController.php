<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Session as Session;
use Stripe\Stripe;
use App\Http\Controllers\ProductController;

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
            'success_url' => route('payment_success', ['data' => $data]),
            'cancel_url' => route('payment_index'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {   
        $data = request()->query('data');

        ProductController::addStock($data);
        
        return redirect()->to($data['start_url']);
    }

    public function hitWebhook()
    {
        require '../../Hooks/stripe.php';
    }
}
