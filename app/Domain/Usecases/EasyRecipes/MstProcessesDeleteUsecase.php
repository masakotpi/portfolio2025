<?php

namespace App\Domain\Usecases\EasyRecipes;

use Exception;
use App\Models\MstProcess;

class MstProcessesDeleteUsecase
{
  public function __invoke(int $id): void
  {
    $mst_process = MstProcess::findOrFail($id);
    $mst_process->delete();

    // $mst_process = MstProcess::find($id);
    // if(is_null($mst_process)){
    //   throw new exception('工程が見つかりません。');
    // }
    // $mst_process->delete();
  }
}
