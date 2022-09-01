<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::delete('ajax/images/{image}',
    \App\Http\Controllers\Ajax\RemoveImageController::class
)->middleware(['admin'])->name('ajax.images.delete');

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard', ['role' => 'Admin']);
    })->name('dashboard');

    Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class)->except(['show']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class)->except(['show']);
});

Route::middleware('auth')->group(function() {
    Route::post('product/{product}/rating/add', [\App\Http\Controllers\ProductsController::class, 'addRating'])->name('product.rating.add');

});

Route::middleware('auth')->name('account.')->prefix('account')->group(function() {
    Route::get('/', [\App\Http\Controllers\Account\UserController::class, 'index'])->name('index');
    Route::get('{user}/edit', [\App\Http\Controllers\Account\UserController::class, 'edit'])
        ->name('edit')
        ->middleware('can:view,user');
    Route::put('{user}', [\App\Http\Controllers\Account\UserController::class, 'update'])
        ->name('update')
        ->middleware('can:update,user');
});

Route::get('/dashboard', function() {
    return view('dashboard', ['role' => 'Customer']);
})->middleware('auth')->name('dashboard');

Route::resource('products', \App\Http\Controllers\ProductsController::class)->only(['show', 'index']);
Route::resource('categories', \App\Http\Controllers\CategoriesController::class)->only(['show', 'index']);

Route::get('cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('cart/{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::delete('cart', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/{product}/count', [\App\Http\Controllers\CartController::class, 'countUpdate'])->name('cart.count.update');
