<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
class modelHasrolesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user_super = User::findOrFail($this->user_search('Jacos Super Admin'));
        $user_super->assignRole('Super Admin','Admin','User');

        $user_admin = User::findOrFail($this->user_search('Jacos Admin'));
        $user_admin->assignRole('Admin','User');

        $user_admins = User::findOrFail($this->user_search('shihab'));
        $user_admins->assignRole('Admin','User');

        $user_adminss = User::findOrFail($this->user_search('Rafi'));
        $user_adminss->assignRole('Admin','User');

        $user_user = User::findOrFail($this->user_search('Jacos User'));
        $user_user->assignRole('User');



        // $user_user = User::findOrFail($this->user_search('Chairman'));
        // $user_user->assignRole('Admin');
        
    }
    private function user_search($user_name){
        $user_info=User::where('name',$user_name)->first();
        return $user_id=$user_info['id'];
    }
}
