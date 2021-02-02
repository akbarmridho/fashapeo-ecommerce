<?php

namespace App\Http\Controllers\Orders;

use App\Actions\Order\PlaceNewOrder;
use App\Actions\Order\UpdateStatus;
use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Repository\StatusRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatedOrderController extends Controller
{
    private $status;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->status = $statusRepository;
    }

    public function create(PlaceNewOrder $creator, UpdateStatus $updater)
    {
        $customer = Auth::guard('customer')->user();

        $order = $creator->place($customer);

        $updater->update($order, $this->status->orderCreated());

        event(new OrderCreated($order));

        return redirect()->route('customer.order.shipment', $order);
    }
}
