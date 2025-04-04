<?php

namespace App\Domain\Usecases\EasyRecipes;

use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Process;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProcessStoreUsecase
{
  public function __invoke($request):void
  {
    $recipe =[];
    foreach($request['process'] as $index => $process){
      $recipe[] = [
        'recipe_id' => $request['recipe_id'],
        'number' => $index,
        'process' => $process,
      ];
    }
      DB::table('processes')->insert($recipe);
  }
}

