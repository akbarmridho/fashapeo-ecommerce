<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\FilepondController;
use App\Http\Controllers\Admin\UpdateProductController;

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

Route::middleware('auth:api', function () {
    Route::post('/process', [FilepondController::class, 'upload'])->name('image.upload');
    Route::delete('/process', [FilepondController::class, 'delete'])->name('image.delete');
});

Route::get('api/master-products/{id}/images', [UpdateProductController::class, 'masterImages']);

Route::get('api/products/{id}/images', [UpdateProductController::class, 'productImage']);