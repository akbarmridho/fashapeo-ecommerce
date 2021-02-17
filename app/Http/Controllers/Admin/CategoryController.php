<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepositoryInterface;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $service;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CategoryService $service)
    {
        $this->category = $categoryRepository;
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->category->all();

        return view('admin.pages.categories')->with('categories', $categories);
    }

    public function edit(Category $id)
    {
        $editCategory = $id;
        $categories = $this->category->parents();

        return view('admin.pages.edit-category', compact('editCategory', 'categories'))->render();
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());

        session()->flash('status', 'Category created');

        return back();
    }

    public function update(Request $request, Category $id)
    {
        if (!$this->service->update($request->all(), $id)) {
            session()->flash('error', 'Categories only support one level of subcategory');
        } else {
            session()->flash('status', 'Category updated');
        }

        return back();
    }

    public function delete(Category $id)
    {
        if (!$this->service->delete($id)) {
            session()->flash('error', 'Category with child cannot be deleted. 
                                       Please dissociate the children first');
        } else {
            session()->flash('status', 'Category deleted');
        }
    }
}
