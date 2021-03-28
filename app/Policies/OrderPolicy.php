<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Customer;
use App\Repository\StatusRepositoryInterface as Status;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    protected $status;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function show(Customer $user, Order $order)
    {
        return $order->customer()->is($user);
    }

    public function markCompleted(Customer $user, Order $order)
    {
        return $order->customer()->is($user) && isset($order->shipment->tracking_number);
    }
}
