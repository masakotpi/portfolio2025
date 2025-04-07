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
  }
}
