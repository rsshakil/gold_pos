<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Maker_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maker_items=array(
            [
                'maker_id' => 1,
                'wholesale_purchase_id' => 1,
                'total_weight' => '20',
                'making_cost_weight' => '3',
                'estimate_return_weight' => '17'
            ],
            [
                'maker_id' => 1,
                'wholesale_purchase_id' => 1,
                'total_weight' => '20',
                'making_cost_weight' => '3',
                'estimate_return_weight' => '17'
            ]
        );
        // DB::table('maker_items')->insert($maker_items);
    }
}
