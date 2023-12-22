<?php

namespace App\Enums\Order;

enum OrderStatusEnum: string
{
    case ORDER_PLACED = 'order placed';
    case ORDER_DISPATCHED = 'dispatched';
    case ORDER_DELIVERED = 'delivered';
}