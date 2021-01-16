<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderRedirectController extends Controllers
{
    public function finish(Request $request)
    {
        if($request->session()->has('order_id')) {
            return redirect()->route('customer.order.success', ['order' => Order::find(session('order_id'))]);
        } else {
            $lastOrder = Auth::guard('customer')
                            ->user()
                            ->orders()
                            ->latest('updated_at')
                            ->first();
            return redirect()->route('customer.order.success', ['order' => $lastOrder]);
        }
    }

    public function unfinish(Request $request)
    {
        if($request->session()->has('order_id')) {
            return redirect()->route('customer.order.pending', ['order' => Order::find(session('order_id'))]);
        } else {
            $lastOrder = Auth::guard('customer')
                            ->user()
                            ->orders()
                            ->latest('updated_at')
                            ->first();
            return redirect()->route('customer.order.pending', ['order' => $lastOrder]);
        }
    }

    public function error(Request $request)
    {
        if($request->session()->has('order_id')) {
            return redirect()->route('customer.order.failed', ['order' => Order::find(session('order_id'))]);
        } else {
            $lastOrder = Auth::guard('customer')
                            ->user()
                            ->orders()
                            ->latest('updated_at')
                            ->first();
            return redirect()->route('customer.order.failed', ['order' => $lastOrder]);
        }
    }
}