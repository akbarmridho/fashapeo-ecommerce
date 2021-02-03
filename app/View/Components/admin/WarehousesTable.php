<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class WarehousesTable extends Component
{
    public $warehouses;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($warehouses)
    {
        $this->warehouses = $warehouses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.warehouses-table');
    }
}
