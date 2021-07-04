<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Wholesale_purchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prdct=array(
            [
                'admin_purchase_categeorie_id' => 1,
                'vendor_id' => 1,
                'item_name' => 'paka gold',
                'weight' => '110.243',
                'price' => '1456000',
                'purchase_datetime' => '2020-02-01 12:57:45'
            ],
            [
                'admin_purchase_categeorie_id' => 1,
                'vendor_id' => 1,
                'item_name' => 'paka gold',
                'weight' => '130.243',
                'price' => '1676000',
                'purchase_datetime' => '2020-02-01 12:57:45'
            ]
            
        );

        
        DB::table('wholesale_purchases')->insert($prdct);
    }
}
