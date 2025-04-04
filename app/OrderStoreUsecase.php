<?php

namespace App\Domain\Usecases;

use App\Models\Product;
use App\Models\Maker;
use App\Models\Order;
use Exception;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderStoreUsecase
{
 
    /**
     * 注文新規登録
     *
     */
    public function __invoke(array $request):object
    {
        $product = (New Product())->find($request['product_id']);
        $request = array_merge($request,['product_name' => $product->name]);
        return  (New Order())->create($request);

    }
}
