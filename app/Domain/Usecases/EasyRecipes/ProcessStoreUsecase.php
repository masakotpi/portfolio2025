<?php

namespace App\Domain\Usecases\EasyRecipes;

use Illuminate\Support\Facades\DB;

class ProcessStoreUsecase
{
  public function __invoke($request):void
  {
    $recipe =[];
    foreach($request['process'] as $index => $process){
      $recipe[] = [
        'recipe_id' => $request['recipe_id'],
        'number' =>  $index+1,
        'process' => $process,
      ];
    }
      DB::table('processes')->insert($recipe);
  }
}

