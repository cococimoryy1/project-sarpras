<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrInsert(
            ['id' => 1, 'name' => 'Admin'], // Pastikan ID juga digunakan
            ['description' => 'Full access to the system']
        );

        Role::updateOrInsert(
            ['id' => 2, 'name' => 'User'],
            ['description' => 'Regular user with limited permissions']
        );
    }
}
