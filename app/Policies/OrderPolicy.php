<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Repository\StatusRepositoryInterface as Status;

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

    public function show(User $user, Order $order)
    {
        return $order->customer()->is($user);
    }

    public function markCompleted(User $user, Order $order)
    {
        return $order->customer()->is($user) && $order->recent_status()->is($this->status->orderShipped());
    }
}
