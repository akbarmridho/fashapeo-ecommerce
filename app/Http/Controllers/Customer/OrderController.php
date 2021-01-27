<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repository\StatusRepositoryInterface;
use App\Actions\Order\UpdateStatus;
use App\Events\OrderCompleted;

class OrderController extends Controller
{
    public $status;

    public function __construct(StatusRepositoryInterface $status)
    {
        $this->status = $status;
    }

    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    public function markAsCompleted(Order $order, UpdateStatus $updater)
    {
        $this->authorize('markCompleted', $order);

        $updater->update($order, $this->status->orderArrived());
        $updater->update($order, $this->status->orderCompleted());
        // update sold count pada master produk
        $order->fill([
            'completed_at' => now(),
            'is_success' => true,
        ])->save();
        event(new OrderCompleted($order));

        return back();
    }
}