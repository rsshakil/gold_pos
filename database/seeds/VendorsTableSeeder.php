<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor_array=array(
            [
                'vendor_name' => 'vendor 1',
                'vendor_email' => 'vendor1@gmail.com',
                'vendor_phone' => '01936755674',
                'vendor_address' => 'Dhaka,Bangladesh'
            ],
            [
                'vendor_name' => 'vendor 2',
                'vendor_email' => 'vendor2@gmail.com',
                'vendor_phone' => '01936755674',
                'vendor_address' => 'Dhaka,Bangladesh'
            ],
            [
                'vendor_name' => 'vendor 3',
                'vendor_email' => 'vendor3@gmail.com',
                'vendor_phone' => '01936755674',
                'vendor_address' => 'Dhaka,Bangladesh'
            ]
        );

        
        DB::table('vendors')->insert($vendor_array);
    }
}
