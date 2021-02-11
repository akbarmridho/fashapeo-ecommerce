<?php

namespace App\Http\Controllers\Orders;

use App\Services\OrderStatus;
use App\Actions\Vendor\Midtrans;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CreatedTransactionController extends Controller
{
    public $status;

    public function __construct(OrderStatus $status)
    {
        $this->status = $status;
    }

    public function show(Order $order, Midtrans $payment)
    {
        $token = Cache::remember('order.' . $order->id . '.key', 60 * 60 * 24, function () use ($payment, $order) {
            return $payment->token($order);
        });

        return view('customer.pages.orders.invoice', compact('order', 'token'));
    }

    public function notification(Midtrans $payment)
    {
        $payment->notification();
        $status = $payment->transaction_status;
        $fraud = $payment->fraud_status;
        $order = Order::where('order_number', $payment->notification->order_id)->first();

        switch ($status) {
            case 'capture':
                if ($fraud === 'accept') {
                    $this->status->transcationSuccess($order);
                } elseif ($fraud === 'challenge') {
                    $payment->approve($payment->notification->order_id);
                }
                break;
            case 'settlement':
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
            default:
                throw new \InvalidArgumentException('Cannot validate status');
                break;
        }
    }
}
