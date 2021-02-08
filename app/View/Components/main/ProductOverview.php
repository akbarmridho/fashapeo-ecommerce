<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class ProductOverview extends Component
{
    public $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.product-overview');
    }
}
