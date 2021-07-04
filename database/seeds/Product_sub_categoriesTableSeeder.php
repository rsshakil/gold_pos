<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_sub_categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productcatss=array(
            [
                'product_categorie_id' => 1,
                'product_sub_cat_name' => 'ring',
            ],
            [
                'product_categorie_id' => 1,
                'product_sub_cat_name' => 'chain',
            ],
            [
                'product_categorie_id' => 1,
                'product_sub_cat_name' => 'neckless',
            ],
            [
                'product_categorie_id' => 2,
                'product_sub_cat_name' => 'ring',
            ],
            [
                'product_categorie_id' => 2,
                'product_sub_cat_name' => 'chain',
            ],
            [
                'product_categorie_id' => 2,
                'product_sub_cat_name' => 'neckless',
            ]
        );

        
        DB::table('product_sub_categories')->insert($productcatss);
    }
}
