<?php

namespace App\Domain\Service;

use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Collection;


class GetProductIndexService
{
   
   public function __invoke():array
   {
      $query =  Product::query()->leftjoin('makers','makers.id','=','products.maker_id');
      $product = Product::with('maker')->get();
      $resourse = new ResourcesProduct($product);

      logger('サービス');
      $products = $query->select(
            'products.id as id',
            'products.name as name',
            'makers.name as maker_name',
            'makers.id as maker_id',
            'code',
            'color',
            'per_case',
            'purchase_price',
            'selling_price',
            'country',
            'person_in_charge',
         )
         ->get();
      $maker_list = maker::pluck('name','id');
      return  compact('products','maker_list');
   }
}