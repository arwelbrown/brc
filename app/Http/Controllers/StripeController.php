<?php

namespace App\Http\Controllers;

use App\Enums\Order\OrderStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Session as Session;
use Stripe\Stripe;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class StripeController extends Controller
{
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
            'cancel_url' => route('payment_failure'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {   
        $data = request()->query('data');

        $currentStock = Product::where('product_name', '=', $data['product_name'])->first()['stock'];
        $newStock  = $currentStock + $data['quantity'];

        $productId = Product::where('product_name', '=', $data['product_name'])
            ->update(['stock' => $newStock])
        ;

        $order = Order::create([
            'product_id' => $productId,
            'user_id' => request()->user()->id,
            'quantity' => $data['quantity'],
            'order_total' => $data['quantity'] * ((int) env('PHYSICAL_ORDER_PRICE') * 100),
            'order_status' => OrderStatusEnum::ORDER_PLACED,
            'created_at' => Carbon::now(),
            'order_id' => uniqid('brc_'),
            'order_details' => $data['product_name'] . ' - ' . $data['quantity'],
        ]);

        $url = getenv('APP_URL') . '/brc-admin/orders/' . $order->id . '/edit';
        
        return redirect()->to($url);
    }

    public function failure()
    {
        return redirect()->back();
    }

    public function hitWebhook()
    {
        require_once '../../Hooks/stripe.php';
    }
}
