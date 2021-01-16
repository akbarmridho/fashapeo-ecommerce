<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index () {
        return view('admin.pages.products');
    }
}
