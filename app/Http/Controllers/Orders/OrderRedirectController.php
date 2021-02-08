<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderRedirectController extends Controller
{
    public function finish(Request $request)
    {
        if ($request->session()->has('order_id')) {
            return redirect()->route('customer.order.status.success', ['order' => Order::find(session('order_id'))]);
        } else {
            $lastOrder = Auth::guard('customer')
                            ->user()
                            ->orders()
                            ->latest('updated_at')
                            ->first();

            return redirect()->route('customer.order.status.success', ['order' => $lastOrder]);
        }
    }

    public function unfinish(Request $request)
    {
        if ($request->session()->has('order_id')) {
            return redirect()->route('customer.order.status.pending', ['order' => Order::find(session('order_id'))]);
        } else {
            $lastOrder = Auth::guard('customer')
                            ->user()
                            ->orders()
                            ->latest('updated_at')
                            ->first();

            return redirect()->route('customer.order.status.pending', ['order' => $lastOrder]);
        }
    }

    public function error(Request $request)
    {
        if ($request->session()->has('order_id')) {
            return redirect()->route('customer.order.status.failed', ['order' => Order::find(session('order_id'))]);
        } else {
            $lastOrder = Auth::guard('customer')
                            ->user()
                            ->orders()
                            ->latest('updated_at')
                            ->first();

            return redirect()->route('customer.order.status.failed', ['order' => $lastOrder]);
        }
    }
}
