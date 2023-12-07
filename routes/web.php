<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyCommerceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;

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

Route::get('/category/create', [CategoryController::class,'index'])->name('category');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/show', [CategoryController::class,'show'])->name('category.show');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::get('/category/delete/{id}', [CategoryController::class,'destroy'])->name('category.destroy');

Route::get('/sub-category/create', [SubCategoryController::class,'index'])->name('subcategory');
Route::post('/sub-category/store',[SubCategoryController::class,'store'])->name('subcategory.store');
Route::get('/sub-category/show', [SubCategoryController::class,'show'])->name('subcategory.show');
Route::get('/sub-category/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
Route::post('/sub-category/update/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
Route::get('/sub-category/delete/{id}', [SubCategoryController::class,'destroy'])->name('subcategory.destroy');

Route::get('/brand/create', [BrandController::class,'index'])->name('brand');
Route::post('/brand/store',[BrandController::class,'store'])->name('brand.store');
Route::get('/brand/show', [BrandController::class,'show'])->name('brand.show');
Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
Route::post('/brand/update/{id}',[BrandController::class,'update'])->name('brand.update');
Route::get('/brand/delete/{id}', [BrandController::class,'destroy'])->name('brand.destroy');

Route::get('/unit/create', [UnitController::class,'index'])->name('unit');
Route::post('/unit/store',[UnitController::class,'store'])->name('unit.store');
Route::get('/unit/show', [UnitController::class,'show'])->name('unit.show');
Route::get('/unit/edit/{id}',[UnitController::class,'edit'])->name('unit.edit');
Route::post('/unit/update/{id}',[UnitController::class,'update'])->name('unit.update');
Route::get('/unit/delete/{id}', [UnitController::class,'destroy'])->name('unit.destroy');

Route::get('/product/create', [ProductController::class,'index'])->name('product');
Route::get('/product/get-subcategory-by-category',[ProductController::class,'getSubcategoryByCategory'])->name('product.get-subcategory-by-category');
Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
Route::get('/product/create', [ProductController::class,'index'])->name('product');
Route::get('/product/show', [ProductController::class,'show'])->name('product.show');
Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('/product/update/{id}',[ProductController::class,'update'])->name('product.update');
Route::get('/product/delete/{id}', [ProductController::class,'destroy'])->name('product.destroy');
Route::get('/product/view/{id}', [ProductController::class,'view'])->name('product.view');
