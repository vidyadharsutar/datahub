<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Super Admin', 'role' => 'superadmin'],
            ['name' => 'Admin', 'role' => 'admin'],
            ['name' => 'Data Manager', 'role' => 'data_manager'],
            ['name' => 'Data Analyst', 'role' => 'data_analyst'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}