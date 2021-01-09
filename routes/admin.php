<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
});