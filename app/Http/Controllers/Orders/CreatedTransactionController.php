<?php

namespace App\Http\Controllers\Orders;

use App\Services\OrderStatus;
use App\Actions\Vendor\Midtrans;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CreatedTransactionController extends Controller
{
    public $status;

    public function __construct(OrderStatus $status)
    {
        $this->status = $status;
    }

    public function show(Order $order)
    {
        session(['order_id' => $order->id]);

        return view('customer.pages.orders.invoice', compact('order'));
    }

    public function token(Order $order, Midtrans $payment)
    {
        return response()->json(['token' => $payment->token($order)], 200);
    }

    public function notification(
        Request $request,
        Midtrans $payment
    ) {
        $payment->notification($request->all());

        $status = $payment->notificaton->transaction_status;
        $fraud = $payment->notification->fraud_status;
        $order = Order::where('order_number', $payment->notification->order_id)->first();

        switch ($status) {
            case 'capture':
                if ($fraud === 'accept') {
                    $this->status->transcationSuccess($order);
                } elseif ($fraud === 'challenge') {
                    $payment->approve($payment->notification->order_id);
                }
                break;
            case 'cancel':
                if ($fraud === 'accept') {
                    $this->status->transactionCancelled($order);
                } elseif ($fraud === 'challenge') {
                    $payment->approve($payment->notification->order_id);
                }
                break;
            case 'deny':
                $this->status->transactionDenied($order);
                break;
            case 'pending':
                $this->status->transcationPending($order);
                break;
            case 'expire':
                $this->status->transactionExpired($order);
                break;
        }
    }
}
