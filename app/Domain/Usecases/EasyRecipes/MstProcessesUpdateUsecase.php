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

class MstProcessesUpdateUsecase
{
  public function __invoke(int $id, array $request): void
  {
    $mst_process = MstProcess::find($id);
    $mst_process->process = $request['process'];
    $mst_process->save();

  }
}
