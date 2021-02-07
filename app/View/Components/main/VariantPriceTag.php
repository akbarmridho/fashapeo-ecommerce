<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class VariantPriceTag extends Component
{
    public $price;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.variant-price-tag');
    }
}
