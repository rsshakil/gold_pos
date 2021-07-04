<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $outlt=array(
            [
                'outlet_name' => 'fariha 1',
                'outlet_email' => 'fariha@gmail.com',
                'outlet_phone' => '01936755674',
                'postal_code' => '1201',
                'address' => 'Baitul mokaram',
                'outlet_desc' => 'awsam',
                'outlet_opentime' => '09:01:01',
                'outlet_closetime' => '09:01:01',
                'weekend_day' => 'Friday'
            ]
            
        );

        
        DB::table('outlets')->insert($outlt);
    }
}
