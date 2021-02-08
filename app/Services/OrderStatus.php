<?php

namespace App\Services;

use App\Models\Order;
use App\Actions\Order\UpdateStatus;
use App\Actions\Order\UpdateOrder;
use App\Events\OrderCreated;
use App\Events\OrderCancelled;
use App\Events\TransactionDenied;
use App\Events\PaymentConfirmed;
use App\Events\PaymentExpired;
use App\Events\OrderCompleted;
use App\Events\OrderShipped;
use App\Repository\StatusRepositoryInterface;

class OrderStatus
{
    protected $status;
    protected $orderUpdater;
    protected $statusUpdater;

    public function __construct(StatusRepositoryInterface $status, UpdateStatus $updater, UpdateOrder $order)
    {
        $this->status = $status;
        $this->statusUpdater = $updater;
        $this->orderUpdater = $order;
    }

    public function orderCreated(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->orderCreated());
        event(new OrderCreated($order));
    }

    public function orderProcessed(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->orderProcessed());
    }

    public function orderCancelled(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->orderCancelled());
        $this->orderUpdater->revertStock($order);
        $this->orderUpdater->updateFailedOrder($order);
        event(new OrderCancelled($order));
    }

    public function orderArrived(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->orderArrived());
        $this->orderCompleted($order);
    }

    public function orderCompleted(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->orderCompleted());
        $this->orderUpdater->completeOrder($order);
        event(new OrderCompleted($order));
    }

    public function shipmentCreated(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->shipmentCreated());
        event(new OrderShipped($order));
    }

    public function transcationSuccess(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->transactionSuccess());
        $this->orderUpdater->updateTransaction($order, request()->all());
        $this->orderUpdater->setDateCompletion($order->transaction);
        $this->orderProcessed($order);
        event(new PaymentConfirmed($order));
    }

    public function transactionCancelled(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->transactionCancelled());
        $this->handleFailedTransaction($order);
        $this->orderCancelled($order);
    }

    public function transactionDenied(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->transactionDenied());
        $this->handleFailedTransaction($order);
        event(new TransactionDenied($order));
        $this->orderCancelled($order);
    }

    public function transactionExpired(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->paymentExpired());
        $this->handleFailedTransaction($order);
        event(new PaymentExpired($order));
        $this->orderCancelled($order);
    }

    public function transcationPending(Order $order)
    {
        $this->statusUpdater->update($order, $this->status->transactionPending());
        $this->orderUpdater->updateTransaction($order, request()->all());
    }

    private function handleFailedTransaction(Order $order)
    {
        $this->orderUpdater->updateTransaction($order, request()->all());
        $this->orderUpdater->setDateCompletion($order->transaction);
    }
}
