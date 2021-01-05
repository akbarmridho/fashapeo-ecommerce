<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RajaongkirController;

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

Route::get('/', function () {
    return view('customer.pages.home');
});

// Route::get('/category', function () {
//     return view('customer.pages.category');
// });

// Route::get('/page', function () {
//     return view('customer.pages.single-page');
// });

// Route::get('/product', function () {
//     return view('customer.pages.product');
// });



// Route::get('/contact', function () {
//     return view('customer.pages.contact');
// });
  


Route::get('/api/provinces', [RajaongkirController::class, 'provinces']);
Route::get('/api/cities/{id}', [RajaongkirController::class, 'cities']);