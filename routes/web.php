<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use Illuminate\Routing\RouteGroup;
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


// Home Page -- Shop Page -- Cart Page
Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{id}', [ProductController::class, 'show'])->name('product');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/delete-from-cart/{id}', [CartController::class, 'deleteFromCart'])->name('delete.from.cart');
Route::put('/update-quantity-from-cart/{id}', [CartController::class, 'updateCartQuantity'])->name('update.from.cart');

// Dashboard
Route::prefix('dashboard')->group(function(){
    Route::get('/', [ProductController::class, 'dashboard'])->name('dashboard.index');
    Route::get('/products', [ProductController::class, 'showAllProducts'])->name('all.products');
    Route::get('/active-products', [ProductController::class, 'showActiveProducts'])->name('active.products');
    Route::get('/deactivated-products', [ProductController::class, 'showDeactivatedProducts'])->name('deactivated.products');
    Route::get('/deleted-products', [ ProductController::class, 'showDeletedProducts' ])->name('deleted.products');
    Route::get('/add-product', [ProductController::class, 'addNewProduct'])->name('add.new.product');
    Route::post('/insert-new-product', [ProductController::class, 'insertNewProduct'])->name('insert.product');
    Route::get('/product/{id}', [ProductController::class, 'showEditProduct'])->name('edit.product');
    Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('update.product');
    Route::put('/soft-delete-product/{id}' , [ProductController::class, 'softDeleteProduct'])->name('soft.delete.product');
    Route::put('/restore-product/{id}', [ ProductController::class, 'restoreProduct' ])->name('restore.product');
    Route::delete('/delete-product/{id}', [ ProductController::class , 'deleteProductCompletely'])->name('delete.product');
});
