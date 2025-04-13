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
    }
}
