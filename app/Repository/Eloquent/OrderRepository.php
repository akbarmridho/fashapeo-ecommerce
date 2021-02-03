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

    public function active(): Collection
    {
        return $this->order->withRelationship()->active()->paginate($this->page);
    }

    public function cancelled(): Collection
    {
        return $this->order->withRelationship()->cancelled()->paginate($this->page);
    }

    public function completed(): Collection
    {
        return $this->order->withRelationship()->completed()->paginate($this->page);
    }
}
