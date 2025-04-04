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
                ["1,2",'薄力粉','g'],
                [1,'バター','g'],
                [1,'砂糖','g'],
                [1,'たまご','個'],
                [1,'牛乳','ml'],
                [1,'生クリーム','ml'],
                [1,'クリームチーズ','g'],
                [1,'レモン汁','小さじ'],
                [1,'ビスケット','枚'],
                [7,'パスタ','枚'],//麺類
                [7,'オリーブオイル','枚'],//麺類
                [7,'ニンニク','片'],//麺類
                [7,'唐辛子','g'],//麺類
                [7,'ベーコン','枚'],//麺類
                [7,'アボカド','枚'],//麺類
        ];
   
        foreach($values as $value){
            $data[] = array_combine($keys,$value);
        }
        DB::table('mst_ingredients')->insert($data);
    }
}
