<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CarouselService;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public $carousel;

    public function __construct(CarouselService $carousel)
    {
        $this->carousel = $carousel;
    }

    public function index()
    {
        return view('admin.pages.carousel');
    }

    public function create()
    {
        return view('admin.pages.create-carousel');
    }

    public function store(Request $request)
    {
        $this->carousel->create($request->all());

        session()->flash('status', 'Carousel created');

        return route('admin.carousel');
    }

    public function update()
    {
        //
    }
}
