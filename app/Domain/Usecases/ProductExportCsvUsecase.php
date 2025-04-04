<?php

namespace App\Domain\Usecases;

use App\Models\Product;
use App\Models\Maker;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ProductExportCsvUsecase
{
    const CSV_HEADER = [
        'id','商品名','商品コード','カラー','入り数','下代（USD）','上代(円)','メーカーID','メーカー名',
    ];
    /**
     * Export CSV
     */
    public function __invoke( Request $request )
    {
                
        if(!isset($request->product_ids)){
            throw ValidationException::withMessages(['商品を選択してください']);
        }

        $products = Product::whereIn('id',$request->product_ids)
        ->select('id','name','code','color','per_case','purchase_price','selling_price','maker_id',)->get();
        $products = $products->map(function($product){
            if(isset($product->maker_id)){
                $maker = Maker::find($product->maker_id);
                $product['maker_name'] =$maker->name ?? null;
                return $product ;
            }
            return $product ;
         });
         $products = collect($products)->toArray();
         $cvsList[] = self::CSV_HEADER;
         foreach($products as $product){
            $cvsList[] = array_values($product);
         }
        $response = new StreamedResponse (function() use ($request, $cvsList){
            $stream = fopen('php://output', 'w');

            //文字化け回避
            // stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            //CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="products.csv"');
 
        return $response;
    }

}
