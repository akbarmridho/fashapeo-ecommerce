<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->category->all();

        return view('admin.pages.categories')->with('categories', $categories);
    }

    public function edit(int $id)
    {
        $editCategory = $this->category->find($id);
        $categories = $this->category->parents();

        return view('admin.pages.edit-category', compact('editCategory', 'categories'))->render();
    }

    public function store(Request $request)
    {
        $this->category->create($request->all());

        session()->flash('status', 'Category created');

        return back();
    }

    public function update(Request $request, int $id)
    {
        if (! $this->category->update($request->all(), $id)) {
            session()->flash('error', 'Categories only support one level of subcategory');
        } else {
            session()->flash('status', 'Category updated');
        }

        return back();
    }

    public function delete(int $id)
    {
        if (! $this->category->delete($id)) {
            session()->flash('error', 'Category with child cannot be deleted. 
                                       Please dissociate the children first');
        } else {
            session()->flash('status', 'Category deleted');
        }
    }
}
