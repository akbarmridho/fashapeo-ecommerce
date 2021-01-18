<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\FilepondController;
use App\Http\Controllers\Admin\UpdateProductController;
use App\Http\Controllers\Vendor\AdministrationController;
use App\Http\Controllers\Orders\CreatedTransactionController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/api/master-products/{id}/images', [UpdateProductController::class, 'masterImages']);
    Route::get('/api/products/{id}/images', [UpdateProductController::class, 'productImage']);
});

Route::post('/api/image/upload', [ImageController::class, 'upload'])->name('image.upload');
Route::post('/api/image/process', [FilepondController::class, 'upload'])->name('image.process');
Route::delete('/api/image/delete', [FilepondController::class, 'delete'])->name('image.delete');

Route::get('/api/provinces', [AdministrationController::class, 'provinces']);
Route::get('/api/cities/{id}', [AdministrationController::class, 'cities']);

Route::post('/api/payment/notification', [CreatedTransactionController::class, 'notification']);