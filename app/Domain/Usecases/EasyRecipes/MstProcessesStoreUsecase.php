<?php

namespace App\Domain\Usecases\EasyRecipes;

use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MstProcess;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MstProcessesStoreUsecase
{
  public function __invoke(array $request): void
  {
    $params = [
    'type'    => $request['type'],
    'process'    => $request['process'],
    ];
    
    MstProcess::create($params);
  }
}
