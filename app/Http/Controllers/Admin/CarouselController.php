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
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function update()
    {
        //
    }
}
