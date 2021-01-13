<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Order\PlaceNewOrder;
use App\Actions\Order\UpdateStatus;
use App\Events\OrderCreated;

class CreatedOrderController extends Controller
{
    public function __construct()
    {
        //
    }

    public function create(PlaceNewOrder $creator, UpdateStatus $updater)
    {
        $customer = Auth::guard('customer')->user();

        $order = $creator->place($customer);
        $status = 'some status model from status repository';

        $updater->update($order, $status);

        event(new OrderCreated($order));

        // return order created response -> redirect ke tahap berikutnya
    }
}