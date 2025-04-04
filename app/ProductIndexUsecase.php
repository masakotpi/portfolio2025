<?php

namespace App\Domain\Usecases;

use App\Models\Product;
use App\Models\Maker;
use App\Domain\Service\GetProductIndexService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductIndexUsecase
{
   Private $get_product_index_service;

   public function __construct(
      GetProductIndexService $get_product_index_service
  ) {
      $this->get_product_index_service = $get_product_index_service;
  }

   public function __invoke():array
   {
      return $this->get_product_index_service->__invoke();
   }
}
