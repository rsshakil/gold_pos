<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Payment_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments=array(
            [
                'payment_type_name' => 'Cash'
            ],
            [
                'payment_type_name' => 'Check'
            ],
            [
                'payment_type_name' => 'Bank Transfer'
            ],
            [
                'payment_type_name' => 'Bkash'
            ],
            [
                'payment_type_name' => 'nexus pay'
            ],
            [
                'payment_type_name' => 'Rocket'
            ]
        );

        
        DB::table('payment_types')->insert($payments);
    }
}
