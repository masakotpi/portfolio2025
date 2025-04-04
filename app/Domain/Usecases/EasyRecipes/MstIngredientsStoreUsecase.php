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

class MstIngredientsStoreUsecase
{
  public function __invoke(Request $request): void
  {

    $type = MstIngredient::where('name', $request['name'])->first();
    if (isset($type)) {
      $type = explode(',', $type->type);
      array_push($type, $request['type']);
      $type = implode(',', array_unique($type));
    }
    $params = [
    'type'    => $type ?? $request['type'],
    'name'    => $request['name'],
    'unit'    => $request['unit'],
    'amount'    => $request['amount'] ?? null,
    'cost'    => $request['cost'] ?? null,
    ];

    MstIngredient::updateOrCreate(
      ['name' => $params['name']],
      $params
    );
  }
}
