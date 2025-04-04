<?php

namespace App\Domain\Usecases\EasyRecipes;

use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MstIngredient;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IngredientsStoreUsecase
{
  public function __invoke($request)
  {
    if(!isset($request['recipe_id'])){
      $recipe = Recipe::create([
        'name' => $request['name'],
        'type' => $request['type'],
      ]);
    }

    if(!isset($request['mst_ingredient_id'])){
      throw new Exception('材料を選択してください。');
    }
    foreach($request['mst_ingredient_id'] as $index => $mst_ingredient_id){
      $ingredient = Ingredient::create([
        'recipe_id' => $recipe->id ?? $request['recipe_id'],
        'mst_ingredient_id' => $mst_ingredient_id,
        'amount' => $request['amount'][$index]
      ]);
    }
    return Recipe::with('ingredient')->find($recipe->id ?? $request['recipe_id']);

  }
}

