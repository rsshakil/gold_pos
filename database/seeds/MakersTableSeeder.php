<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maker_array=array(
            [
                'maker_name' => 'maker 1',
                'maker_email' => 'vendor1@gmail.com',
                'maker_phone' => '01936755674',
                'maker_address' => 'Dhaka,Bangladesh'
            ],
            [
                'maker_name' => 'maker 2',
                'maker_email' => 'vendor2@gmail.com',
                'maker_phone' => '01936755674',
                'maker_address' => 'Dhaka,Bangladesh'
            ],
            [
                'makername' => 'maker 3',
                'maker_email' => 'vendor3@gmail.com',
                'maker_phone' => '01936755674',
                'maker_address' => 'Dhaka,Bangladesh'
            ]
        );

        
        DB::table('makers')->insert($maker_array);
    }
}
