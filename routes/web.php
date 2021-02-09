<?php

use App\Http\Controllers\Main\MainPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainPageController::class, 'home'])->name('home');

Route::middleware('last.visited')->get('/product/{product:slug}', [MainPageController::class, 'product'])->name('product');

Route::get('/category/{category:slug}', [MainPageController::class, 'category'])
    ->name('products.category');

Route::get('/search', [MainPageController::class, 'search'])
    ->name('products.search');

// Route::get('/page', function () {
//     return view('customer.pages.single-page');
// });

// Route::get('/contact', function () {
//     return view('customer.pages.contact');
// });
