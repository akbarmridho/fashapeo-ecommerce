<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class EditWarehouseForm extends Component
{
    public $warehouse;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($warehouse)
    {
        $this->warehouse = $warehouse;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.edit-warehouse-form');
    }
}
