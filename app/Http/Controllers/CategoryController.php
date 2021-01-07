<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    private $category;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    public function create(Request $request)
    {
        $this->category->create($request->all());

        session()->flash('status', 'Category created');

        return back();
    }

    public function update(Request $request, int $id)
    {
        $this->category->update($request->all(), $id);

        session()->flash('status', 'Category updated');

        return back();
    }
}
