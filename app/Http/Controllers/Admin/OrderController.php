<?php

namespace App\Http\Controllers\Admin;

use App\Services\OrderStatus;
use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $status;
    public $order;

    public function __construct(OrderStatus $status, OrderRepositoryInterface $order)
    {
        $this->status = $status;
        $this->order = $order;
    }

    public function show(Order $order)
    {
        return view('admin.pages.order-detail', compact('order'));
    }

    public function active()
    {
        $orders = $this->order->active();

        return view('admin.pages.active-orders', compact('orders'));
    }

    public function cancelled()
    {
        $orders = $this->order->cancelled();

        return view('admin.pages.cancelled-orders', compact('orders'));
    }

    public function completed()
    {
        $orders = $this->order->completed();

        return view('admin.pages.completed-orders', compact('orders'));
    }

    public function setTrackingNumber(Order $order, Request $request)
    {
        $validated = $request->validate(['tracking_number' => 'string|required|max:100']);

        $order->shipment->tracking_number = $validated['tracking_number'];
        $order->push();

        $this->status->orderShipped($order);

        session()->flash('status', 'Tracking number updated');

        return redirect()->route('admin.orders.active');
    }

    public function complete(Order $order)
    {
        $this->status->orderCompleted($order);

        session()->flash('status', 'Order Completed');

        return back();
    }

    public function cancel(Order $order)
    {
        $this->status->orderCancelled($order);

        session()->flash('status', 'Order Cancelled');

        return back();
    }

    public function delete(Order $order)
    {
        $order->delete();
        session()->flash('status', 'Order Deleted');

        return back();
    }
}
