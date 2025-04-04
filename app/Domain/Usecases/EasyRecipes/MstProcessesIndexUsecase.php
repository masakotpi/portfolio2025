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

class MstProcessesIndexUsecase
{
  public function __invoke(Request $request):Collection
  {
    $mst_processes = MstProcess::where('type', $request['type'])->get();
    return $mst_processes;
  }
}
