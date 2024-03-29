<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Collection;
use App\Repository\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;
    protected $page = 10;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function active()
    {
        return $this->order->withRelationship()->latest()->active()->paginate($this->page);
    }

    public function cancelled()
    {
        return $this->order->withRelationship()->latest()->cancelled()->paginate($this->page);
    }

    public function completed()
    {
        return $this->order->withRelationship()->latest()->completed()->paginate($this->page);
    }
}
