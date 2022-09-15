<?php

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

Route::post('auth', \App\Http\Controllers\Api\AuthController::class)->name('auth');

Route::prefix('v1')->group(function() {
    Route::get('products', \App\Http\Controllers\Api\ProductsController::class);
    Route::get('categories', \App\Http\Controllers\Api\CategoriesController::class);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('user', \App\Http\Controllers\Api\UsersController::class);
        Route::get('user/orders', \App\Http\Controllers\Api\OrdersController::class);
        Route::get('orders', \App\Http\Controllers\Api\Admin\OrdersController::class);
    });

});
