<?php

use Illuminate\Support\Facades\Route; 
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware(['guest'])
        ->name('login');

    Route::middleware(['auth:admin', 'verified'])->group(function () {
        Route::get('/', function () {
            return view('admin.pages.welcome');
        });

    });
});