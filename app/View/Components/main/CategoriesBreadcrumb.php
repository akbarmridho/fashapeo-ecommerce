<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class CategoriesBreadcrumb extends Component
{
    public $category;
    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category, $categories)
    {
        $this->category = $category;
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.categories-breadcrumb');
    }
}
