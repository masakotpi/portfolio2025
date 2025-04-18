<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesTableSeeder extends Seeder
{
    /**
     * レシピシーダー
     *
     * @return void
     */
    public function run()
    {
        $keys =[
            'type','main_image','name'];

        $values = [
                ["7",'recipe_images/apasta.jpg','アボカドと海老のパスタ'],
                ["1",'recipe_images/cheese_cake.jpg','チーズケーキ'],
                ["1",'recipe_images/macaron.jpg','マカロン'],
                ["2",'recipe_images/pizza.jpg','ピザ'],
                ["2",'recipe_images/rollpan.jpg','ロールパン'],
                ["1",'recipe_images/scone.jpg','スコーン'],
                ["2",'recipe_images/shiopan.jpg','塩バターパン'],
                ["1",'recipe_images/short_cake.jpg','ショートケーキ'],
                ["3",'recipe_images/tacosarad.jpg','タコサラダ'],
        ];

        foreach($values as $value){
            $data[] = array_combine($keys,$value);
        }
        DB::table('recipes')->insert($data);

        $keys =[
            'recipe_id','mst_ingredient_id','amount'];
        $values = [
                //アボカドパスタ
                ["1","10",'100'],
                ["1","11",'5'],
                ["1","12",'5'],
                ["1","13",'1'],
                ["1","14",'5'],
                ["1","15",'1'],

                //チーズケーキ
                ["2","1",'20'],
                ["2","2",'20'],
                ["2","3",'30'],
                ["2","4",'1'],
                ["2","5",'50'],
                ["2","6",'200'],
                ["2","7",'200'],
                ["2","8",'1'],
                ["2","9",'20'],

                //ピザ
                ["4","16",'300'],
                ["4","17",'5'],
                ["4","20",'70'],
                ["4","21",'10'],

                //塩バターパン
                ["7","16",'300'],
                ["7","17",'5'],
                ["7","18",'30'],
                ["7","19",'20'],
                ["7","20",'50'],
                ["7","21",'10'],
        
        ];
        foreach($values as $value){
            $data[] = array_combine($keys,$value);
        }
        logger($data);
        DB::table('ingredients')->insert($data);
            
   
    }
}
