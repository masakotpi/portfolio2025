<?php

namespace App\Domain\Usecases\EasyRecipes;

use Carbon\Carbon;
use Exception;
use App\Models\Ingredient;
use App\Models\Recipe;

class IngredientsStoreUsecase
{
  public function __invoke($request)
  {
    if(!isset($request['recipe_id'])){
      $recipe = Recipe::create([
        'name' => $request['name'],
        'type' => $request['type'],
        'updated_at' => Carbon::now(),
        'created_at' => Carbon::now(),
        'main_image' => null,
        'kcal' => null,
        'time' => null,
        'cost' => null,
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

