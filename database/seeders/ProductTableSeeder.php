<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_keys =[
            'name','code','maker_id','color','per_case','purchase_price','selling_price',
        ];

        $product_values = [
                ["typeC-USB cable 1.5m",'usb1.50','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.51','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.52','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.53','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.54','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.55','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.56','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.57','1','ブラック',120,1.20,1280],
                ["typeC-USB cable 1.5m",'usb1.58','1','ブラック',120,1.20,1280],
        ];

        foreach($product_values as $value){
            $products[] = array_combine($product_keys,$value);
        }


        $makers =[
            [
                'name'=> 'HongKong Cable Company',
                'country'=> 'HongKong',
                'person_in_charge'=> 'Wilson Ho',
                'address'=> 'HongKong',
                'tel' => '852-0000-0000'
            ],
            [
                'name'=> 'China Plastic Assemble Factory',
                'country'=> 'China',
                'person_in_charge'=> 'David Li',
                'address'=> 'Dongguan Shenzhen China',
                'tel' => '86-000-0000-0000'
            ],
            [
                'name'=> 'China Package Factory',
                'country'=> 'China',
                'person_in_charge'=> 'Sunny Fu',
                'address'=> 'Dongguan Shenzhen China',
                'tel' =>  '86-000-1111-1111'
            ],
            [
                'name'=> 'Korea Plastic Design Ltd',
                'country'=> 'Korea',
                'person_in_charge'=> 'Jason Kim',
                'address'=> 'Seoul Korea',
                'tel' => '82-0000-0000'
            ],
            [
                'name'=> 'US Cable Company',
                'country'=> 'US',
                'person_in_charge'=> 'Kevin ',
                'address'=> 'LA US',
                'tel' => '01-00-0000-0000'
            ],
        ];

    
        DB::table('products')->insert($products);
        DB::table('makers')->insert($makers);
    }
}
