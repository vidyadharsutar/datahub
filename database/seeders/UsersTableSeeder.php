<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $superAdminRole = Role::where('role', 'superadmin')->first();

        User::create([
            'firstname'       => 'Super',
            'lastname'        => 'Admin',
            'email'      => 'admin@vmdatahub.com',
            'phone'      => '+1 9563251254',
            'password'   => bcrypt('password'), // set a default password
            'status'    => 'active',
            'role_id'    => $superAdminRole->_id, // MongoDB uses _id
            'department' => 'Administration',
            'two_factor_auth' => 0,
            'session_timeout' => 30,
            'email_notification' => 0,
            'push_notification' => 0,
            'sms_notification' => 0,
            'timezone' => 'UTC',
            'language' => 'en',
            'last_login' => now(),
        ]);
    }
}