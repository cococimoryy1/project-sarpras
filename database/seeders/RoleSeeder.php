<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'Full access to the system'],
            ['name' => 'User', 'description' => 'Regular user with limited permissions'],
        ]);
    }
}
