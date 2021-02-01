<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;

class CreatedOrderStatus extends Controller
{
    public function success(Order $order)
    {
        return view('customer.pages.orders.pending');
    }

    public function failed(Order $order)
    {
        return view('customer.pages.orders.success');
    }

    public function pending(Order $order)
    {
        return view('customer.pages.orders.error');
    }
}
