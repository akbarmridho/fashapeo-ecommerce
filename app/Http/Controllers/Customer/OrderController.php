<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Order\UpdateStatus;
use App\Events\OrderCompleted;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repository\StatusRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public $status;

    public function __construct(StatusRepositoryInterface $status)
    {
        $this->status = $status;
    }

    public function index()
    {
        return view('customer.pages.my-account.orders');
    }

    public function show()
    {
        return view('customer.pages.my-account.order-details');
    }

    public function markAsCompleted(Order $order, UpdateStatus $updater)
    {
        $this->authorize('markCompleted', $order);

        $updater->update($order, $this->status->orderArrived());
        $updater->update($order, $this->status->orderCompleted());
        $order->fill([
            'completed_at' => now(),
            'is_success' => true,
        ])->save();
        event(new OrderCompleted($order));

        return back();
    }
}
