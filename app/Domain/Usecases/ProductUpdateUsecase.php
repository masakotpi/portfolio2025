<?php

namespace App\Domain\Usecases;

use App\Models\Product;
use App\Models\Maker;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductUpdateUsecase
{
  public function __invoke(int $id, array $request):void
  {
    //利益チェック
    if($request['purchase_price']*120 > $request['selling_price']*0.25){
      throw new Exception('利益がありません。'.$request['purchase_price']*120*4 .'円以上の上代にする必要があります。');
    }

    //重複チェック
    $duplicated_code_product = Product::where('code',$request['code'])->first();
    if(isset($duplicated_code_product) && $duplicated_code_product->id !== $id ){
      throw new Exception('コードが重複して登録ができません。');
    }
    
    $product =  Product::find($id);
    $product->fill($request)->save();
  }
}

