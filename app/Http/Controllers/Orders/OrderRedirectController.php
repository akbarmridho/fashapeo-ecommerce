<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderRedirectController extends Controller
{
    public function finish(Request $request)
    {
        // $order = Order::where('order_number', $request->order_id)->first();

        return view('customer.pages.orders.success');
        // return redirect()->route('customer.order.status.success', ['order' => $order]);
    }

    public function unfinish(Request $request)
    {
        // $order = Order::where('order_number', $request->order_id)->first();

        return view('customer.pages.orders.pending');
        // return redirect()->route('customer.order.status.pending', ['order' => $order]);
    }

    public function error(Request $request)
    {
        // $order = Order::where('order_number', $request->order_id)->first();

        return view('customer.pages.orders.error');
        // return redirect()->route('customer.order.status.failed', ['order' => $order]);
    }
}
