<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Order\UpdateStatus;
use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repository\StatusRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $status;
    public $order;

    public function __construct(StatusRepositoryInterface $status, OrderRepositoryInterface $order)
    {
        $this->status = $status;
        $this->order = $order;
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

    public function setTrackingNumber(Order $order, Request $request, UpdateStatus $updater)
    {
        $validated = $request->validate(['tracking_number' => 'string|required|max:100']);

        $order->shipment->tracking_number = $validated['tracking_number'];
        $order->push();

        $updater->update($order, $this->status->orderShipped());
        event(new OrderShipped($order));

        session()->flash('status', 'Tracking number updated');

        return back();
    }

    public function complete(Order $order)
    {
        //
    }

    public function cancel(Order $order)
    {
        //
    }

    public function delete(Order $order)
    {
        //
    }
}
