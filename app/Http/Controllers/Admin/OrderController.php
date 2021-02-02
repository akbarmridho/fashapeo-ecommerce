<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Order\UpdateStatus;
use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repository\StatusRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $status;

    public function __construct(StatusRepositoryInterface $status)
    {
        $this->status = $status;
    }

    public function active()
    {
        //
    }

    public function cancelled()
    {
        //
    }

    public function completed()
    {
        //
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
}
