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

class MstIngredientsDeleteUsecase
{
  public function __invoke(int $id, string $type): void
  {

    $mst_ingredient = MstIngredient::where('id', $id)->first();
    $type_array = explode(',',$mst_ingredient->type);
    //アロー関数
    $res = array_filter($type_array, fn ($val) => $val !== $type);
    $mst_ingredient->type = implode(',',$res);
    $mst_ingredient->save();

  }
}
