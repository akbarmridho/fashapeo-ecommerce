<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class OrderDetail extends Component
{
    public $order;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.order-detail');
    }
}
