<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrInsert(
            ['name' => 'Admin'], // Kondisi untuk mengecek duplikat
            ['description' => 'Full access to the system'] // Data yang di-update atau ditambahkan
        );

        Role::updateOrInsert(
            ['name' => 'User'],
            ['description' => 'Regular user with limited permissions']
        );
    }
}
