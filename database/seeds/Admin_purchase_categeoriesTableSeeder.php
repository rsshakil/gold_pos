<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Admin_purchase_categeoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purchase_cat=array(
            [
                'purchase_cat_name' => 'pure gold'
            ],
            [
                'purchase_cat_name' => '22 caret gold'
            ],
            [
                'purchase_cat_name' => '21 caret gold'
            ],
            [
                'purchase_cat_name' => 'Diamon'
            ],
            [
                'purchase_cat_name' => 'Platinam'
            ],
            [
                'purchase_cat_name' => 'Other'
            ]
        );

        
        DB::table('admin_purchase_categeories')->insert($purchase_cat);
    }
}
