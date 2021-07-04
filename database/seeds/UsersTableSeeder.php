<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_array=array(
            [
                'name' => 'Jacos Super Admin',
                'email' => 'super_admin@jacos.co.jp',
                'password' => bcrypt('Qe75ymSr')
            ],
            [
                'name' => 'shihab',
                'email' => 'outlet1@gmail.com',
                'password' => bcrypt('Qe75ymSr_fariha1#123')
            ],
            [
                'name' => 'Rafi',
                'email' => 'outlet2@gmail.com',
                'password' => bcrypt('Qe75ymSr_fariha2#321')
            ],
            [
                'name' => 'Jacos Admin',
                'email' => 'admin@jacos.co.jp',
                'password' => bcrypt('Qe75ymSr')
            ],
            [
                'name' => 'Jacos User',
                'email' => 'user@jacos.co.jp',
                'password' => bcrypt('Qe75ymSr')
            ]
        );

        
        DB::table('users')->insert($user_array);
        
    }
}
