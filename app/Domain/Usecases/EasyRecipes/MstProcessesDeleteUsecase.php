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

class MstProcessesDeleteUsecase
{
  public function __invoke(int $id): void
  {
    $mst_process = MstProcess::find($id);
    if(is_null($mst_process)){
      throw new exception('工程が見つかりません。');
    }
    $mst_process->delete();
  }
}
