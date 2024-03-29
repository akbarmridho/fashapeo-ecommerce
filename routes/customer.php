<?php

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
use Illuminate\Support\Facades\Route;

Route::name('customer.')->group(function () {
    Route::get('/my-account', [CustomerController::class, 'dashboard'])->name('dashboard');

    Route::get('/cart', [CartController::class, 'show'])
        ->name('carts');

    Route::post('/cart', [CartController::class, 'add'])
        ->name('carts.add');

    Route::put('/cart', [CartController::class, 'update'])
        ->name('carts.update');

    Route::delete('/cart/{id}', [CartController::class, 'delete'])
        ->name('carts.delete');

    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlists');

    Route::post('/wishlist', [WishlistController::class, 'store'])
        ->name('wishlists.store');

    Route::delete('/wishlist/{id}', [WishlistController::class, 'delete'])
        ->name('wishlists.delete');

    Route::prefix('my-account')->group(function () {
        Route::get('notifications', [CustomerController::class, 'notification'])
            ->name('notification');

        Route::get('edit-account', [CustomerController::class, 'profile'])
            ->name('profile');

        Route::get('address', [AddressController::class, 'index'])
            ->name('address');

        Route::get('address/create', [AddressController::class, 'create'])
            ->name('address.create');

        Route::post('address/create', [AddressController::class, 'store']);

        Route::middleware('can:update,address')->group(function () {
            Route::get('address/edit/{address}', [AddressController::class, 'edit'])
                ->name('address.show');

            Route::put('address/edit/{address}', [AddressController::class, 'update'])
                ->name('address.update');

            Route::delete('address/edit/{address}', [AddressController::class, 'delete'])
                ->name('address.delete');

            Route::put('address/edit/{address}/main', [AddressController::class, 'setMain'])
                ->name('address.main');
        });

        Route::get('orders', [OrderController::class, 'index'])
            ->name('orders');

        Route::get('orders/{order:order_number}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::post('orders/{order:order_number}/complete', [OrderController::class, 'markAsCompleted'])
            ->name('orders.complete');
    });

    Route::prefix('order')->group(function () {
        Route::post('/', [CreatedOrderController::class, 'create'])
            ->name('order.create');

        Route::middleware(['order.check:shipment', 'can:show,order'])->group(function () {
            Route::get('/{order:order_number}/shipment', [CreatedShipmentController::class, 'show'])
                ->name('order.shipment');

            // Route::put('/{order:order_number}/shipment', [CreatedShipmentController::class, 'update'])
            //     ->name('order.shipment.update');

            Route::post('/{order:order_number}/shipment', [CreatedShipmentController::class, 'finalize'])
                ->name('order.shipment.finalize');

            // Route::get('/{order:order_number}/shipment/cost', [ShipmentOptionController::class, 'show'])
            //     ->name('order.shipment.cost');
        });

        Route::middleware(['order.check:transaction', 'can:show,order'])->group(function () {
            Route::get('/{order:order_number}/transaction', [CreatedTransactionController::class, 'show'])
                ->name('order.transaction');
        });

        Route::get('/status/finish', [OrderRedirectController::class, 'finish']);

        Route::get('/status/unfinish', [OrderRedirectController::class, 'unfinish']);

        Route::get('/status/error', [OrderRedirectController::class, 'error']);

        Route::middleware(['order.check:success', 'can:show,order'])->get('/{order:order_number}/success', [CreatedOrderStatus::class, 'success'])
            ->name('order.status.success');

        Route::middleware(['order.check:failed', 'can:show,order'])->get('/{order:order_number}/failed', [CreatedOrderStatus::class, 'failed'])
            ->name('order.status.failed');

        Route::middleware(['order.check:pending', 'can:show,order'])->get('/{order:order_number}/pending', [CreatedOrderStatus::class, 'pending'])
            ->name('order.status.pending');
    });
});
