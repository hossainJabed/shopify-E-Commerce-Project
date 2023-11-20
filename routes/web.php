<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyCommerceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MyCommerceController::class,'index'])->name('home');
Route::get('/product-category', [MyCommerceController::class,'category'])->name('product.category');
Route::get('/product-detail', [MyCommerceController::class,'detail'])->name('product.detail');
Route::get('/show-card', [CartController::class,'index'])->name('show.card');
Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
