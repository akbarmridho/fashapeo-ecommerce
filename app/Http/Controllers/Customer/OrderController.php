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
        return view('customer.pages.my-account.orders');
    }

    public function show()
    {
        return view('customer.pages.my-account.order-details');
    }

    public function markAsCompleted(Order $order, UpdateStatus $updater)
    {
        $this->authorize('markCompleted', $order);

        $this->status->orderArrived($order);

        return back();
    }
}
