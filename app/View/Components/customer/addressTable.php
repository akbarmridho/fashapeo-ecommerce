<?php

namespace App\View\Components\customer;

use Illuminate\View\Component;

class addressTable extends Component
{
    public $addresses;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.customer.address-table');
    }
}
