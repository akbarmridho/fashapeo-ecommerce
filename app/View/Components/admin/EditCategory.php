<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class EditCategory extends Component
{
    public $categories;
    public $editCategory;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $editCategory)
    {
        $this->categories = $categories;
        $this->editCategory = $editCategory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.create-category');
    }
}
