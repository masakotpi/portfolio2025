<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientTableSeeder extends Seeder
{
    /**
     * 材料シーダー
     *
     * @return void
     */
    public function run()
    {
        $keys =[
            'type','name','unit',
        ];

        $values = [
                [1,'薄力粉','g'],
                [1,'バター','g'],
                [1,'砂糖','g'],
                [1,'たまご','個'],
                [1,'牛乳','ml'],
                [1,'生クリーム','ml'],
                [1,'クリームチーズ','g'],
                [1,'レモン汁','小さじ'],
                [1,'ビスケット','枚'],
                //麺類
                [7,'パスタ','枚'],
                [7,'オリーブオイル','cc'],
                [7,'ニンニク','片'],
                [7,'唐辛子','g'],
                [7,'海老','尾'],
                [7,'アボカド','個'],
                //パン
                [2,'強力粉','g'],
                [2,'イースト','g'],
                [2,'バター','g'],
                [2,'牛乳','g'],
                [2,'水','ml'],
                [2,'塩','g'],
                [2,'砂糖','g'],
                //サラダ
                [3,'レタス','g'],
                [3,'トマト','g'],
                [3,'きゅうり','g'],
                [3,'玉ねぎ','g'],
                [3,'ブロッコリー','g'],
                [3,'ドレッシング','g'],
                [3,'ひき肉','g'],
        ];
   
        foreach($values as $value){
            $data[] = array_combine($keys,$value);
        }
        DB::table('mst_ingredients')->insert($data);
    }
}
