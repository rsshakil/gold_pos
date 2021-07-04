<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SitesettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
            [
                'company_name' => 'Fariha Jewellry',
                'company_logo' => 'logo.jpg',
                'platinam_21_carat_price' => '6230',
                'diamond_21_carat_price' => '6230',
                'gold_21_carat_price' => '4230',
                'platinam_22_carat_price' => '5230',
                'diamond_22_carat_price' => '6230',
                'gold_22_carat_price' => '6230',
                'ruturn_decrease_percent' => '10',
                'purchase_decrease_percent' => '20',
            ]
            );
            DB::table('sitesettings')->insert($settings);
    }
}
