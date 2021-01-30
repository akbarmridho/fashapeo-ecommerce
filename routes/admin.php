<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CreatedProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\UpdateProductController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\VariantController;

Route::prefix('admin')->name('admin.')->group(function () {
    
        Route::get('/', function () {
            return view('admin.pages.welcome');
        })->name('dashboard');

        Route::get('categories', [CategoryController::class, 'index'])
            ->name('categories');

        Route::get('categories/{id}', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::post('categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::delete('categories/{id}', [CategoryController::class, 'delete'])
            ->name('categories.delete');

        Route::put('categories/{id}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::get('variants', [VariantController::class, 'index'])
            ->name('variants');

        Route::get('variants/{id}', [VariantController::class, 'edit'])
            ->name('variants.edit');

        Route::post('variants', [VariantController::class, 'store'])
            ->name('variants.store');

        Route::put('variants/{id}', [VariantController::class, 'update'])
            ->name('variants.update');

        Route::delete('variants/{id}', [VariantController::class, 'delete'])
            ->name('variants.delete');
        
        Route::get('products', [ProductController::class, 'index'])
            ->name('products');

        Route::get('products/create', [CreatedProductController::class, 'create'])
            ->name('products.create');

        Route::post('products/create', [CreatedProductController::class, 'store']);

        Route::get('products/edit/{product}', [UpdateProductController::class, 'show'])
            ->name('products.edit');
        
        Route::put('products/edit/{product}', [UpdateProductController::class, 'update']);

        Route::delete('products/edit/{product}/archive', [CreatedProductController::class, 'archive'])
            ->name('products.archive');
        
        Route::delete('products/edit/{product}', [CreatedProductController::class, 'delete'])
            ->name('products.delete');

        Route::get('discounts', [ProductDiscountController::class, 'index'])
            ->name('discounts');

        Route::get('discounts/{id}', [ProductDiscountController::class, 'show'])
            ->name('discounts.show');

        Route::post('discounts/{id}', [ProductDiscountController::class, 'update']);

        Route::delete('discounts/{id}', [ProductDiscountController::class, 'delete'])
            ->name('discounts.delete');

        Route::get('warehouse', [WarehouseController::class, 'index'])
            ->name('warehouse');

        Route::get('warehouse/{id}', [WarehouseController::class, 'show'])
            ->name('warehouse.show');

        Route::get('warehouse/create', [WarehouseController::class, 'create'])
            ->name('warehouse.create');

        Route::post('warehouse/create', [WarehouseController::class, 'store']);

        Route::delete('warehouse/{id}', [WarehouseController::class, 'delete'])
            ->name('warehouse.delete');

        Route::put('warehouse/{id}/address', [WarehouseController::class, 'updateAddress'])
            ->name('warehouse.address');

        Route::put('warehouse/{id}', [WarehouseController::class, 'updateWarehouse']);

        Route::post('warehouse/{id}/main', [WarehouseController::class, 'setMain'])
            ->name('warehouse.main');

        Route::get('orders', [OrderController::class, 'active'])
            ->name('orders.active');

        Route::get('orders/cancelled', [OrderController::class, 'cancelled'])
            ->name('orders.cancelled');

        Route::get('orders/completed', [OrderController::class, 'archived'])
            ->name('orders.completed');

        Route::post('orders/{id}/tracking', [OrderController::class, 'setTrackingNumber'])
            ->name('orders.tracking');
});