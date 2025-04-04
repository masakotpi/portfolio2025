<?php

namespace App\Domain\Usecases\EasyRecipes;

use Exception;
use App\Models\Recipe;

class RecipeIndexUsecase
{
  public function __invoke($request)
  {
    $query = Recipe::query();
    $query->with('ingredient.mstIngredient','process');
    if($request->name){
      $query->where('name',$request->name);
    }
    if($request->type){
      $query->where('type',$request->type);
    }
    $recipes = $query->get();
    return [
      'names' => isset($request->type)? Recipe::where('type',$request->type)->pluck('name','name'):Recipe::pluck('name','name') ,
      'types' => isset($request->name)? Recipe::where('name',$request->name)->pluck('type','type') :Recipe::pluck('type','type'),
      'data' => $recipes
    ];

  }
}

