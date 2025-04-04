<?php

namespace App\Domain\Usecases\EasyRecipes;

use App\Models\Ingredient;
use App\Models\MstIngredient;
use Exception;
use App\Models\Recipe;

class RecipeShowUsecase
{
  public function __invoke(int $id)
  {
    $recipe = Recipe::with('ingredient.mstIngredient','process')->find($id);
    $mst_ingredient_selector = MstIngredient::where('type', 'like', "%$recipe->type%")->pluck('name','id');

    return compact('recipe','mst_ingredient_selector') ;
  }
}

