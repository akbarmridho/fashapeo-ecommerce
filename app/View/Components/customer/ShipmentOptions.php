<?php

namespace App\View\Components\customer;

use Illuminate\View\Component;

class ShipmentOptions extends Component
{
    public $order;
    public $shipments;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($order, $shipments)
    {
        $this->order = $order;
        $this->shipments = $shipments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.customer.shipment-options');
    }
}
