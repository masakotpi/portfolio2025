<?php

namespace App\Domain\Usecases\EasyRecipes;

use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Process;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UploadImageUsecase
{
  public function __invoke($request)
  {
    $filename = "{$request['recipe_id']}_{$request['file']->getClientOriginalName()}";
    $directory = $request['directory'];
    $path = $directory.'/'.$filename;
    //レシピDBに保存と削除
    $file = Storage::disk('public')->putFileAs($directory, $request['file'], $filename);
    $recipe = Recipe::find($request['recipe_id']);
    if($recipe->main_image){
      Storage::disk('public')->delete([$recipe->main_image]);   
    }
    $recipe->main_image = $path ;
    $recipe->save();

    return [
      'path' => $path,
      'url' => Storage::url($file),
    ];
  }
}

