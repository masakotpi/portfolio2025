<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Models\MstIngredient;

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

Route::get('/nikoniko', function () {
  $data = MstIngredient::get();
  return response()->json($data);
});


 logger("APIルートにきたよ");
  Route::get('/user', function (Request $request) {
      return $request->user();
  });


  //画像アップロード
  Route::post('/recipes/image', [RecipeController::class, 'upload'])->name('image_upload');
