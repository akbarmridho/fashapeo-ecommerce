<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use App\Events\PaymentConfirmed;
use App\Events\OrderCancelled;
use App\Events\PaymentExpired;
use App\Events\TransactionDenied;
use App\Actions\Order\UpdateStatus;
use App\Actions\Order\UpdateOrder;
use App\Actions\Vendor\Midtrans;
use App\Repository\StatusRepositoryInterface;

class CreatedTransactionController extends Controller
{
    public $status;

    public function __construct(StatusRepositoryInterface $status)
    {
        $this->status = $status;
    }

    public function show(Order $order)
    {
        session(['order_id' => $order->id]);

        return view('customer.pages.orders.invoice');
    }

    public function token(Order $order, Midtrans $payment)
    {
        return response()->json(['token' => $payment->token($order)], 200);
    }

    public function notification(
        Request $request,
        Midtrans $payment,
        UpdateStatus $updater,
        UpdateOrder $handler
    ) {
        $payment->notification($request->all());

        $status = $payment->notificaton->transaction_status;
        $fraud = $payment->notification->fraud_status;
        $order = Order::where('order_number', $payment->notification->order_id)->first();

        switch ($status) {
            case 'capture':
                if ($fraud === 'accept') {
                    $updater->update($order, $this->status->transactionSuccess());
                    $updater->update($order, $this->status->orderProcessed());
                    $handler->updateTransaction($order, $request->all());
                    $this->setDateCompletion($order->transaction);
                    event(new PaymentConfirmed($order));
                } else if ($fraud === 'challenge') {
                    $payment->approve($payment->notification->order_id);
                }
                break;
            case 'cancel':
                if ($fraud === 'accept') {
                    $updater->update($order, $this->status->transactionCancelled());
                    $updater->update($order, $this->status->orderCancelled());
                    $handler->updateTransaction($order, $request->all());
                    $handler->revertStock($order);
                    $this->cancelOrder($order);
                } else if ($fraud === 'challenge') {
                    $payment->approve($payment->notification->order_id);
                }
                break;
            case 'deny':
                $updater->update($order, $this->status->transactionDenied());
                $updater->update($order, $this->status->orderCancelled());
                $handler->updateTransaction($order, $request->all());
                $handler->revertStock($order);
                event(new TransactionDenied($order));
                $this->cancelOrder($order);
                break;
            case 'pending':
                $updater->update($order, $this->status->transactionPending());
                $handler->updateTransaction($order, $request->all());
                break;
            case 'expire':
                $updater->update($order, $this->status->paymentExpired());
                $updater->update($order, $this->status->orderCancelled());
                $handler->updateTransaction($order, $request->all());
                $handler->revertStock($order);
                event(new PaymentExpired($order));
                $this->cancelOrder($order);
                break;
        }
    }

    private function setDateCompletion(Transaction $transaction)
    {
        $transaction->fill(['completed_at' => now()])->save();
    }

    private function updateFailedOrder(Order $order)
    {
        $order->fill([
            'completed_at' => now(),
            'is_success' => false,
        ])->save();
    }

    private function cancelOrder($order)
    {
        $this->setDateCompletion($order->transaction);
        $this->updateFailedOrder($order);
        event(new OrderCancelled($order));
    }
}
