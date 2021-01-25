<?php

namespace App\Http\Controllers\Admin;

use App\Models\Variant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VariantController extends Controller
{
    public function index()
    {
        return view('admin.pages.variations')->with('variations', Variant::withCount('products')->get());
    }

    public function edit(Variant $id)
    {
        return view('admin.pages.edit-variation', ['variation' => $id])->render();
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|max:255|unique:variants']);

        Variant::create(['name' => Str::title($validated['name'])]);

        session()->flash('status', 'Variation created');

        return back();
    }

    public function update(Request $request, Variant $id)
    {
        $validated = $request->validate(['name' => 'required|max:255|unique:variants']);

        $id->fill(['name' => Str::title($validated['name'])])->save();

        session()->flash('status', 'Variation Updated');

        return back();
    }

    public function delete(Variant $id)
    {
        $id->delete();

        session()->flash('status', 'Variant deleted');
    }
}