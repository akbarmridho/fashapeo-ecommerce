<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class ProductPriceTag extends Component
{
    public $price;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $price)
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
        return view('components.main.product-price-tag');
    }
}
