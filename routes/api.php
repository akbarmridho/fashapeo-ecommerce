<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\FilepondController;
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

Route::post('/image/upload', [ImageController::class, 'upload'])->name('image.upload');
Route::post('/image/process', [FilepondController::class, 'upload'])->name('image.process');
Route::delete('/image/delete', [FilepondController::class, 'delete'])->name('image.delete');
Route::get('/image/load', [FilepondController::class, 'load'])->name('image.load');

Route::get('/provinces', [AdministrationController::class, 'provinces']);
Route::get('/cities/{id}', [AdministrationController::class, 'cities']);

Route::post('/payment/notification', [CreatedTransactionController::class, 'notification']);