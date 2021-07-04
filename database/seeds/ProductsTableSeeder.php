<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            [
                'wholesale_purchase_id' => 1,
                'product_categorie_id' => 1,
                'product_sub_categorie_id' => 1,
                'product_name' => 'test',
                'product_desc' => 'test',
                'weight' => '11.243',
                'price' => '1456000',
                'outlet_id' => 1,
            ],
            [
                'wholesale_purchase_id' => 1,
                'product_categorie_id' => 1,
                'product_sub_categorie_id' => 1,
                'product_name' => 'test',
                'product_desc' => 'test',
                'weight' => '13.243',
                'outlet_id' => 1
            ]
        );
        // DB::table('products')->insert($products);
    }
}
