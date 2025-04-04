<?php

namespace App\Domain\Usecases\EasyRecipes;

use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MstIngredient;
use App\Models\MstProcess;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IngredientsIndexUsecase
{
  public function __invoke($search):array
  {
    $type = $search['type'] ?? 1;
    $query = MstIngredient::query();

    $query->where('type','like', "%$type%" ?? null);

    $ingredient = $query->get();
    $process =MstProcess::where('type','like', "%$type%" ?? null)->get();
    return compact('ingredient','process');
  }
}

