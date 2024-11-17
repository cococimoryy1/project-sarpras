<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'), // Gunakan password hashing
                'role_id' => 1, // ID role 'Admin'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'), // Gunakan password hashing
                'role_id' => 2, // ID role 'User'
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
