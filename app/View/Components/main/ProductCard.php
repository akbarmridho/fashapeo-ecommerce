<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class ProductCard extends Component
{
    public $product;
    public $tag;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product, $tag)
    {
        $this->product = $product;
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.product-card');
    }
}
