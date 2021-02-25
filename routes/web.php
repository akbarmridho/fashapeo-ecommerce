<?php

use App\Http\Controllers\Main\MainPageController;
use App\Http\Controllers\NotificationController;
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

Route::middleware('auth:admin,customer')->group(function () {
    Route::post('/notification/{notification}', [NotificationController::class, 'read'])
        ->name('notification.read');
    Route::post('/notification', [NotificationController::class, 'readAll'])
        ->name('notification.all');
});

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
