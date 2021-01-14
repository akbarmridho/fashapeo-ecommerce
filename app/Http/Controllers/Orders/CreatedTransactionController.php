<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Actions\Order\UpdateStatus;
use App\Actions\Vendor\Midtrans;
use App\Repository\StatusRepositoryInterface;

class CreatedTransactionController extends Controller
{
    public function __construct(StatusRepositoryInterface $status)
    {
        $this->status = $status;
    }

    public function show(Order $order)
    {
        //
    }

    public function token(Order $order, Midtrans $provider)
    {
        return response()->json(['token' => $provider->token($order)], 200);
    }

    public function notification(Request $request, Midtrans $payment)
    {
        $payment->notification($request->all());
        $payment->handle();

        // set status and event if success, set status if failed
    }
}