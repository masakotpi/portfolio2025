<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecipeController;
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

  //材料マスタ一覧
  Route::get('/mst_ingredients', [RecipeController::class, 'mstIngredientsIndex'])->name('mst_ingredients_index');
  //材料マスタ登録
  Route::post('/mst_ingredients', [RecipeController::class, 'mstIngredientsStore'])->name('mst_ingredients_store');
  //材料マスタ更新
  Route::put('/mst_ingredients/{id}', [RecipeController::class, 'mstIngredientsUpdate'])->name('mst_ingredients_update');
  //材料マスタ削除
  Route::delete('/mst_ingredients/{id}/{type}', [RecipeController::class, 'mstIngredientsDelete'])->name('mst_ingredients_delete');
 
  //工程マスタ一覧
  Route::get('/mst_processes', [RecipeController::class, 'mstprocessIndex'])->name('mst_process_index');
  //工程マスタ登録
  Route::post('/mst_processes', [RecipeController::class, 'mstprocessStore'])->name('mst_process_store');
  //工程マスタ更新
  Route::put('/mst_processes/{id}', [RecipeController::class, 'mstprocessUpdate'])->name('mst_process_update');
  //工程マスタ削除
  Route::delete('/mst_processes/{id}', [RecipeController::class, 'mstprocessDelete'])->name('mst_process_delete');
  
  ##########################################
  
  //レシピ一覧
  Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes_list');
  //レシピ詳細
  Route::get('/recipes/{id}', [RecipeController::class, 'recipeShow'])->name('recipes_show');

  //材料一覧
  Route::get('/ingredients', [RecipeController::class, 'ingredientsIndex'])->name('ingredients_list');
  //材料登録
  Route::post('/ingredients', [RecipeController::class, 'ingredientsStore'])->name('ingredients_store');
  //材料詳細
  Route::get('/ingredients/{id}', [RecipeController::class, 'ingredientsDetail'])->name('ingredients_detail');
  //材料削除
  Route::delete('/ingredients/delete/{id}', [RecipeController::class, 'ingredientsDelete'])->name('ingredients_delete');
  
  //工程登録
  Route::post('/recipes/process', [RecipeController::class, 'processStore'])->name('process_store');
  //工程更新
  Route::put('/process/{id}', [RecipeController::class, 'processUpdate'])->name('process_update');
  //工程削除
  Route::delete('/process/{id}', [RecipeController::class, 'processDelete'])->name('process_delete');
  
});
