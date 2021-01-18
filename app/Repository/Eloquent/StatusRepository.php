<?php

namespace App\Repository\Eloquent;

use App\Models\Status;
use App\Repository\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface
{
    private $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function find(int $code): Status
    {
        return $this->status->where('code', $code)->first();
    }

    public function orderCreated(): Status
    {
        return $this->find(101);
    }

    public function orderPending(): Status
    {
        return $this->find(102);
    }

    public function orderProcessed(): Status
    {
        return $this->find(103);
    }

    public function orderCompleted(): Status
    {
        return $this->find(104);
    }

    public function customerOrderCancelled(): Status
    {
        return $this->find(201);
    }

    public function orderCancelled(): Status
    {
        return $this->find(202);
    }

    public function shipmentCreated(): Status
    {
        return $this->find(301);
    }

    public function orderShipped(): Status
    {
        return $this->find(302);
    }

    public function orderArrived(): Status
    {
        return $this->find(303);
    }

    public function transactionCreated(): Status
    {
        return $this->find(501);
    }

    public function transactionPending(): Status
    {
        return $this->find(502);
    }

    public function transactionSuccess(): Status
    {
        return $this->find(503);
    }

    public function paymentExpired(): Status
    {
        return $this->find(504);
    }

    public function transactionDenied(): Status
    {
        return $this->find(601);
    }

    public function transactionFailed(): Status
    {
        return $this->find(602);
    }

    public function transactionCancelled(): Status
    {
        return $this->find(603);
    }
}