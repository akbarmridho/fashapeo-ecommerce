<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;

class MainPageController extends Controller
{
    public function home()
    {
        return view('main.pages.home');
    }
}
