<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Orders\CreatedTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('optimizeImages')->post('/image/upload', [ImageController::class, 'upload'])->name('image.upload');
Route::middleware('optimizeImages')->post('/image/process', [FilepondController::class, 'upload'])->name('image.process');
Route::delete('/image/delete', [FilepondController::class, 'delete'])->name('image.delete');
Route::get('/image', [FilepondController::class, 'load'])->name('image.load');

Route::get('/provinces', [AdministrationController::class, 'provinces']);
Route::get('/cities', [AdministrationController::class, 'cities']);

Route::post('/payment/notification', [CreatedTransactionController::class, 'notification']);
