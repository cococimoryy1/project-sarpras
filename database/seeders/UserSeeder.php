<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan Admin
        User::updateOrInsert(
            ['username' => 'admin'], // Kondisi untuk mengecek keberadaan data
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role_id' => 1, // ID role Admin
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Tambahkan User Biasa
        User::updateOrInsert(
            ['username' => 'user'],
            [
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'),
                'role_id' => 2, // ID role User
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
