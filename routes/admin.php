<?php

use Illuminate\Support\Facades\Route; 
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware(['guest'])
        ->name('login');
});