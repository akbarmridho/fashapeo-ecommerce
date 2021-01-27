<?php

namespace App\Repository\Cache;

use App\Repository\StatusRepositoryInterface;
use App\Repository\Eloquent\StatusRepository as EloquentStatusRepository;
use Illuminate\Support\Facades\Cache;
use App\Models\Status;

class StatusRepository implements StatusRepositoryInterface
{
    private $parent;
    private $time = 60*60*24*30;

    public function __construct(EloquentStatusRepository $parent)
    {
        $this->parent = $parent;
    }

    public function find(int $code): Status
    {
        return Cache::remember('status.find:' . $code, $this->time, function($code) {
            return $this->parent->find($code);
        });
    }

    public function orderCreated(): Status
    {
        return Cache::remember('status.order_created', $this->time, function() {
            return $this->parent->orderCreated();
        });
    }

    public function orderPending(): Status
    {
        return Cache::remember('status.order_pending', $this->time, function() {
            return $this->parent->orderPending();
        });
    }

    public function orderProcessed(): Status
    {
        return Cache::remember('status.order_processed', $this->time, function() {
            return $this->parent->orderProcessed();
        });
    }

    public function orderCompleted(): Status
    {
        return Cache::remember('status.order_completed', $this->time, function() {
            return $this->parent->orderCompleted();
        });
    }

    public function customerOrderCancelled(): Status
    {
        return Cache::remember('status.customer_order_cancelled', $this->time, function() {
            return $this->parent->customerOrderCancelled();
        });
    }

    public function orderCancelled(): Status
    {
        return Cache::remember('status.order_cancelled', $this->time, function() {
            return $this->parent->orderCancelled();
        });
    }

    public function shipmentCreated(): Status
    {
        return Cache::remember('status.shipment_created', $this->time, function() {
            return $this->parent->shipmentCreated();
        });
    }

    public function orderShipped(): Status
    {
        return Cache::remember('status.order_shipped', $this->time, function() {
            return $this->parent->orderShipped();
        });
    }

    public function orderArrived(): Status
    {
        return Cache::remember('status.order_arrived', $this->time, function() {
            return $this->parent->orderArrived();
        });
    }

    public function orderExpired(): Status
    {
        return Cache::remember('status.order_expired', $this->time, function() {
            return $this->parent->orderExpired();
        });
    }

    public function transactionCreated(): Status
    {
        return Cache::remember('status.transaction_created', $this->time, function() {
            return $this->parent->transactionCreated();
        });
    }

    public function transactionPending(): Status
    {
        return Cache::remember('status.transaction_pending', $this->time, function() {
            return $this->parent->transactionPending();
        });
    }

    public function transactionSuccess(): Status
    {
        return Cache::remember('status.transaction_success', $this->time, function() {
            return $this->parent->transactionSuccess();
        });
    }

    public function paymentExpired(): Status
    {
        return Cache::remember('status.payment_expired', $this->time, function() {
            return $this->parent->paymentExpired();
        });
    }

    public function transactionDenied(): Status
    {
        return Cache::remember('status.transaction_denied', $this->time, function() {
            return $this->parent->transactionDenied();
        });
    }

    public function transactionFailed(): Status
    {
        return Cache::remember('status.transaction_failed', $this->time, function() {
            return $this->parent->transactionFailed();
        });
    }

    public function transactionCancelled(): Status
    {
        return Cache::remember('status.transaction_cancelled', $this->time, function() {
            return $this->parent->transactionCancelled();
        });
    }
}