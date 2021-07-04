<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productcats=array(
            [
                'category_name' => 'Gold'
            ],
            [
                'category_name' => 'Diamond'
            ],
            [
                'category_name' => 'Platinam'
            ]
        );

        
        DB::table('product_categories')->insert($productcats);
    }
}
