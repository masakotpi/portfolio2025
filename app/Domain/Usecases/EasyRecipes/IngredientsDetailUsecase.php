<?php

namespace App\Domain\Usecases\EasyRecipes;

use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MstIngredient;
use App\Models\Ingredient;
use App\Models\MstProcess;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IngredientsDetailUsecase
{
  public function __invoke(int $id)
  {
    $ingredient = (New Ingredient())
    ->join('mst_ingredients','mst_ingredients.id','ingredients.mst_ingredient_id')
    ->where('recipe_id',$id)->get();

    $recipe = Recipe::with('mstIngredient')->find($id);
    $recipe->toArray();
    $recipe['ingredient'] = $ingredient;
    $recipe['process'] = $recipe->mstProcess->pluck('process')->toArray();

    $process = MstProcess::where('type','like', "%$recipe->type%" ?? null)->get();
    return $recipe;
   
  }
}

