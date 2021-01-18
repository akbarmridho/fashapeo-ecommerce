<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Orders\CreatedOrderController;
use App\Http\Controllers\Orders\CreatedOrderStatus;
use App\Http\Controllers\Orders\CreatedShipmentController;
use App\Http\Controllers\Orders\CreatedTransactionController;
use App\Http\Controllers\Orders\OrderRedirectController;
use App\Http\Controllers\Orders\ShipmentOptionController;

Route::name('customer.')->group(function () {

    Route::get('/my-account', function () {
        return view('customer.pages.my-account.dashboard');
    })->name('dashboard');

    Route::get('/cart', [CartController::class, 'show'])
        ->name('carts');

    Route::post('/cart/{id}/increment', [CartController::class, 'increment'])
        ->name('carts.increment');

    Route::post('/cart/{id}/decrement', [CartController::class, 'decrement'])
        ->name('carts.decrement');

    Route::delete('/cart/{id}', [CartController::class, 'delete'])
        ->name('carts.delete');

    Route::get('/wishlists', [WishlistController::class, 'index'])
        ->name('wishlists');

    Route::post('/products/{product:slug}/wishlist', [WishlistController::class, 'store'])
        ->name('wishlists.store');

    Route::delete('/wishlists/{id}', [WishlistController::class, 'delete'])
        ->name('wishlists.delete');

    Route::prefix('my-account')->group(function () {

        Route::get('address', [AddressController::class, 'index'])
            ->name('address');

        Route::get('address/{id}', [AddressController::class, 'edit'])
            ->name('address.show');

        Route::get('address/create', [AddressController::class, 'create'])
            ->name('address.create');

        Route::post('address/create', [AddressController::class, 'store']);

        Route::put('address/{id}', [AddressController::class, 'update'])
            ->name('address.update');

        Route::delete('address/{id}', [AddressController::class, 'delete']);

        Route::post('address/{id}/main', [AddressController::class, 'setMain'])
            ->name('address.main');

        Route::get('orders', [OrderController::class, 'index'])
            ->name('orders');

        Route::get('orders/{order:order_number}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::post('orders/order:order_number}/complete', [OrderController::class, 'markAsCompleted'])
            ->name('orders.complete');
    });

    Route::prefix('order')->group(function () {
        Route::post('/', [CreatedOrderController::class, 'create'])
            ->name('order.create');

        Route::get('/{order:order_number}/shipment', [CreatedShipmentController::class, 'show'])
            ->name('order.shipment');

        Route::put('/{order:order_number}/shipment', [CreatedShipmentController::class, 'update'])
            ->name('order.shipment.update');

        Route::post('/{order:order_number}/shipment', [CreatedShipmentController::class, 'finalize'])
            ->name('order.shipment.finalize');

        Route::get('/{order:order_number}/shipment/cost', [ShipmentOptionController::class, 'show'])
            ->name('order.shipment.cost');

        Route::get('/{order:order_number}/transaction', [CreatedTransactionController::class, 'show'])
            ->name('order.transaction');

        Route::get('/{order:order_number}/transaction/token', [CreatedTransactionController::class, 'token'])
            ->name('order.transaction.token');

        Route::get('/finish', [OrderRedirectController::class, 'finish']);

        Route::get('/unfinish', [OrderRedirectController::class, 'unfinish']);

        Route::get('/error', [OrderRedirectController::class, 'error']);
        
        Route::get('/{order:order_number}/success', [CreatedOrderStatus::class, 'success'])
            ->name('order.success');

        Route::get('/{order:order_number}/failed', [CreatedOrderStatus::class, 'failed'])
            ->name('order.failed');

        Route::get('/{order:order_number}/pending', [CreatedOrderStatus::class, 'pending'])
            ->name('order.pending');
    });
});

// Route::get('/cart', function () {
//     return view('customer.pages.cart');
// });

// Route::get('/wishlist', function () {
//     return view('customer.pages.wishlist');
// });



// Route::get('/my-account/notifications', function () {
//     return view('customer.pages.my-account.notifications');
// });

// Route::get('/my-account/orders', function () {
//     return view('customer.pages.my-account.orders');
// });

// Route::get('/my-account/orders/details', function () {
//     return view('customer.pages.my-account.order-details');
// });

// Route::get('/my-account/addresses', function () {
//     return view('customer.pages.my-account.addresses');
// });

// Route::get('/my-account/addresses/add', function () {
//     return view('customer.pages.my-account.add-address');
// });

// Route::get('/my-account/edit-account', function () {
//     return view('customer.pages.my-account.edit-account');
// });

// Route::get('/orders/shipment', function () {
//     return view('customer.pages.orders.shipment');
// });

// Route::get('/orders/invoice', function () {
//     return view('customer.pages.orders.invoice');
// });

// Route::get('/orders/pending', function () {
//     return view('customer.pages.orders.pending');
// });

// Route::get('/orders/success', function () {
//     return view('customer.pages.orders.success');
// });

// Route::get('/orders/error', function () {
//     return view('customer.pages.orders.error');
// });