<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Roleuser;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // INSERT USERS
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@aranproduk.com',
            'password' => app('hash')->make('rahasia')
        ]);

        // INSERT ROLES
        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'admin'
        ]);

        // INSERT RELATION USERS AND ROLES
        Roleuser::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
    }
}
