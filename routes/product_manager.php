<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MakerController;

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

Route::middleware('auth')->group(function () {

  //商品一覧
  Route::get('/products', [ProductController::class, 'index'])->name('products_list');
  //商品更新
  Route::put('/products/{id}', [ProductController::class, 'update'])->name('product_update');
  //商品削除
  Route::post('/products/delete', [ProductController::class, 'delete'])->name('product_delete');
  //CSVエクスポート
  Route::post('/products/csv_export', [ProductController::class, 'export'])->name('products_export');
  //CSVインポート
  Route::post('/products/csv_import', [ProductController::class, 'import'])->name('products_import');


  //発注一覧
  Route::get('/orders', [OrderController::class,'index'])->name('order_index');
  //発注登録
  Route::post('/orders/new', [OrderController::class, 'store'])->name('order_new');
  //発注更新
  Route::put('/orders/{id}', [OrderController::class, 'update'])->name('order_update');
  //PDF発注書発行
  Route::post('/orders/shippings', [OrderController::class, 'updateShippings'])->name('order_update_shippings');
  //入荷予定更新
  Route::post('/orders/issue_po', [OrderController::class, 'issuePo'])->name('issue_po');
  //注文削除
  Route::post('/orders/delete', [OrderController::class, 'delete'])->name('order_delete');
  

  //メーカー一覧
  Route::get('/makers', [MakerController::class, 'index'])->name('maker_index');
  //メーカー登録
  Route::post('/makers/new', [MakerController::class, 'store'])->name('maker_new');
  //メーカー更新
  Route::put('/makers/{id}', [MakerController::class, 'update'])->name('maker_update');
  //メーカー削除
  Route::delete('/makers/delete', [MakerController::class, 'delete'])->name('maker_delete');

});
