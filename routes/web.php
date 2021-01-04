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
 
Route::get('/login', function () {
    return view('customer.pages.login');
});

Route::get('/register', function () {
    return view('customer.pages.register');
});

Route::get('/category', function () {
    return view('customer.pages.category');
});

Route::get('/page', function () {
    return view('customer.pages.single-page');
});

Route::get('/product', function () {
    return view('customer.pages.product');
});

Route::get('/cart', function () {
    return view('customer.pages.cart');
});

Route::get('/wishlist', function () {
    return view('customer.pages.wishlist');
});

Route::get('/contact', function () {
    return view('customer.pages.contact');
});
  
Route::get('/my-account', function () {
    return view('customer.pages.my-account.dashboard');
});

Route::get('/my-account/notifications', function () {
    return view('customer.pages.my-account.notifications');
});

Route::get('/my-account/orders', function () {
    return view('customer.pages.my-account.orders');
});

Route::get('/my-account/orders/details', function () {
    return view('customer.pages.my-account.order-details');
});

Route::get('/my-account/addresses', function () {
    return view('customer.pages.my-account.addresses');
});

Route::get('/my-account/addresses/add', function () {
    return view('customer.pages.my-account.add-address');
});

Route::get('/my-account/edit-account', function () {
    return view('customer.pages.my-account.edit-account');
});

Route::get('/orders/shipment', function () {
    return view('customer.pages.orders.shipment');
});

Route::get('/orders/invoice', function () {
    return view('customer.pages.orders.invoice');
});

Route::get('/orders/pending', function () {
    return view('customer.pages.orders.pending');
});

Route::get('/orders/success', function () {
    return view('customer.pages.orders.success');
});

Route::get('/orders/error', function () {
    return view('customer.pages.orders.error');
});

Route::get('/api/provinces', [RajaongkirController::class, 'provinces']);
Route::get('/api/cities/{id}', [RajaongkirController::class, 'cities']);