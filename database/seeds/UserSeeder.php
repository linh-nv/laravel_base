<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $rootUser=\App\Models\User::create([ 'name' => 'Root', 'phone' => '0896633863', 'password' => bcrypt(1), 'status_id' => 1]);
        $rootUser->assignRole('root');
//        $rootUser->syncPermissions(\Spatie\Permission\Models\Permission::all());

        $staffUser=\App\Models\User::create([ 'name' => 'Staff', 'phone' => '0996633863', 'password' => bcrypt(1), 'status_id' => 1]);
        $staffUser->assignRole('staff');

        $shareholderUser=\App\Models\User::create([ 'name' => 'Shareholder', 'phone' => '0996633873', 'password' => bcrypt(1), 'status_id' => 1]);
        $shareholderUser->assignRole('shareholder');

    }
}
