<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessTableSeeder extends Seeder
{
    /**
     * 工程シーダー
     *
     * @return void
     */
    public function run()
    {
        $keys =[
            'type','process',
        ];

        $values = [
                ["1",'生地をよくこねる'],
                ["1",'を加える'],
                ["1",'を混ぜ合わせる'],
                ["1",'を振るう'],
                ["1",'冷蔵庫でねかせる'],
                ["1",'180度のオーブンで焼く'],
                ["1",'生地'],
                ["7",'お湯を沸かし塩を加え、パスタを所定の時間茹でる。'],
                ["7",'フライパンにオリーブオイル、ニンニク、ベーコンを加え弱火で炒める。'],
        ];
   
        foreach($values as $value){
            $data[] = array_combine($keys,$value);
        }
        DB::table('mst_processes')->insert($data);
    }
}
