<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class ProductCardGroup extends Component
{
    public $title;
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $products)
    {
        $this->title = $title;
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.product-card-group');
    }
}
