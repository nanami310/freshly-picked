<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// 商品一覧表示
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品登録画面表示
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// 商品登録処理
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 商品詳細表示
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');

// 商品編集画面表示
Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');

// 商品更新処理
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update');

// 商品削除処理
Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');

// 商品検索
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');