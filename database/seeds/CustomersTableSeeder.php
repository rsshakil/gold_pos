<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer_array=array(
            [
                'customer_name' => 'Abul',
                'customer_email' => 'vendor1@gmail.com',
                'customer_phone' => '01936755674',
                'customer_address' => 'Dhaka,Bangladesh'
            ],
            [
                'customer_name' => 'Karim',
                'customer_email' => 'vendor2@gmail.com',
                'customer_phone' => '01936755674',
                'customer_address' => 'Dhaka,Bangladesh'
            ],
            [
                'customer_name' => 'Rahim',
                'customer_email' => 'vendor3@gmail.com',
                'customer_phone' => '01936755674',
                'customer_address' => 'Dhaka,Bangladesh'
            ]
        );

        
        DB::table('customers')->insert($customer_array);
    }
}
