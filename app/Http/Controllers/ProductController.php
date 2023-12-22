<?php

namespace App\Http\Controllers;

use App\Enums\Order\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
    public static function addStock(array $data)
    {
        $currentStock = Product::where('product_name', '=', $data['product_name'])->first()['stock'];
        $newStock  = $currentStock + $data['quantity'];

        $productId = Product::where('product_name', '=', $data['product_name'])
            ->update(['stock' => $newStock])
        ;

        Order::create([
            'product_id' => $productId,
            'user_id' => request()->user()->id,
            'quantity' => $data['quantity'],
            'order_total' => $data['quantity'] * ((int) env('PHYSICAL_ORDER_PRICE') * 100),
            'order_status' => OrderStatusEnum::ORDER_PLACED,
            'created_at' => Carbon::now(),
            'order_id' => uniqid('brc_'),
            'order_details' => $data['product_name'] . ' - ' . $data['quantity'],
        ]);
    }
}
