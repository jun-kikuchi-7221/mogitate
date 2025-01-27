<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DetailController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // 商品一覧
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search'); // 検索

Route::get('/products/register', [RegisterController::class, 'create'])->name('products.create'); // 商品登録
Route::post('/register', [RegisterController::class, 'store'])->name('products.store'); // 商品登録処理

Route::get('/products/{productId}', [DetailController::class, 'show'])->name('products.show');// 商品詳細
Route::put('/products/{productId}/update', [DetailController::class, 'update'])->name('products.update'); // 商品更新
Route::delete('/details/{productId}/delete', [DetailController::class, 'destroy'])->name('products.destroy'); // 商品削除