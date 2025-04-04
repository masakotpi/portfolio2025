<?php

namespace App\Domain\Usecases;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductImportCsvUsecase
{
    const CSV_HEADER = [
        'id',
        '商品名',
        '商品コード',
        'カラー',
        '入り数',
        '下代（USD）',
        '上代(円)',
        'メーカーID',
        'メーカー名',
    ];
    
    /**
     * インポート処理
     */
    public function __invoke($request)
    {
        $products = Product::get();
        $errors =[];
        // ファイルを保存
        if($request->hasFile('csvdata')) {
            if($request->csvdata->getClientOriginalExtension() !== "csv") {
                throw new Exception("拡張子が不正です。");
            }
            $request->csvdata->storeAs('public/', "products.csv");
        } else {
            throw ValidationException::withMessages(['CSVファイルの取得に失敗しました。']);

        }
        // ファイル内容取得
        $csv = Storage::disk('local')->get('public/products.csv');
        // 改行コードを統一
        $csv = str_replace(array("\r\n","\r"), "\n", $csv);
        // 行単位のコレクション作成
        $data = collect(explode("\n", $csv));
      
        
        // header作成と項目数チェック
        $header = collect(self::CSV_HEADER);
        $fileHeader = collect(explode(",", $data->shift()));
        logger('fileHeader');logger($fileHeader);
        if($header->count() !== $fileHeader->count()) {
            throw ValidationException::withMessages(['項目数エラー']);
        }
        
        
        //ヘッダー行とデータ行をキーとバリューにして結合させる。
        $datas = $data->map(function ($oneline) use ($header) {
            if($oneline){
                return $header->combine(collect(explode(",", $oneline)));
            }
        });
        //データ最終行がNULLだったら削除する。
        if(!$datas->last()){
            $datas->pop();
        }

        // バリデーションチェック
        $datas->each(function($product) {
            if(!$this->validate($product)) {
                return false;
            }
        });


        // CSV内での重複チェック
        if($datas->duplicates("商品コード")->count() > 0) {
            $errors[] = "CSV内での商品コード重複エラー：" . $datas->duplicates("商品コード")->shift();
        }
      

        // $products = Product::get();
        $codes = array_column($products->toArray(),'code');
        //既存コードにインポートコードが存在するか
        foreach($datas as $index => $data){
            $data = $data->toArray();
            $row = (int) $index +1;
            if(in_array($data['商品コード'] ,$codes ,true)){
                $errors[] = "$row 行目：商品コード：$data[商品コード]が重複していますので重複しないよう書き直してください。";
            }
        }
   

        $datas = $datas->map(function($data){
            return $data =[
                'name' => $data['商品名'],
                'code' => $data['商品コード'],
                'maker_id' => $data['メーカーID'],
                'color' => $data['カラー'],
                'per_case' => $data['入り数'],
                'purchase_price' => $data['下代（USD）'],
                'selling_price' => $data['上代(円)'],
            ];
          
         });

        //エラーを出力
        if(count($errors) >0){
            return $errors;
        }

        DB::table('products')->insert($datas->toArray());
        return [];

    }

   /**
     * バリデーションチェック
     */
    private function validate($product)
    {
        // 必須チェック
        // 必要に応じて他の項目にも適用
        if(empty($product['id'])) {
            $product->put('error', '必須項目エラー');
            return false;
        }


        return true;
    }
}
