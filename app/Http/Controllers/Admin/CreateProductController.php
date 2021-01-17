<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\CreateNewProduct;

class CreateProductController extends Controller
{
    public function create()
    {
        //
    }

    public function update()
    {
        //
    }

    public function creator(CreateNewProduct $creator, Request $request)
    {
        $product = $creator->create($request->all());

        session()->flash('status', 'Product uploaded');

        return redirect()->route('admin.products');
    }

    public function updater()
    {
        //
    }

    public function delete()
    {
        //
    }
}