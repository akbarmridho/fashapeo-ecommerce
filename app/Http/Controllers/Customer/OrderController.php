<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Order\UpdateStatus;
use App\Events\OrderCompleted;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public $status;

    public function __construct(OrderStatus $status)
    {
        $this->status = $status;
    }

    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $orders = $customer->orders()->latest()->paginate(10);
        return view('customer.pages.my-account.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('customer.pages.my-account.order-details', compact('order'));
    }

    public function markAsCompleted(Order $order)
    {
        $this->authorize('markCompleted', $order);

        $this->status->orderArrived($order);

        session()->flash('status', 'Order has marked as completed');

        return redirect()->route('customer.orders');
    }
}
