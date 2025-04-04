<?php

namespace App\Domain\Usecases\EasyRecipes;

use Exception;
use App\Models\MstIngredient;

class MstIngredientsUpdateUsecase
{
  public function __invoke(int $id, array $request): void
  {

    $mst_ingredient = MstIngredient::find($id);
    $mst_ingredient->fill($request)->save();
    
  }
}
