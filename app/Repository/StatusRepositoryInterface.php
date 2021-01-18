<?php

namespace App\Repository;

use App\Models\Status;

interface StatusRepositoryInterface {

    public function find(int $code): Status;

    public function orderCreated(): Status;

    public function orderPending(): Status;

    public function orderProcessed(): Status;

    public function orderCompleted(): Status;

    public function customerOrderCancelled(): Status;

    public function orderCancelled(): Status;

    public function shipmentCreated(): Status;

    public function orderShipped(): Status;

    public function orderArrived(): Status;

    public function transactionCreated(): Status;

    public function transactionPending(): Status;

    public function transactionSuccess(): Status;

    public function paymentExpired(): Status;

    public function transactionDenied(): Status;

    public function transactionFailed(): Status;

    public function transactionCancelled(): Status;
}