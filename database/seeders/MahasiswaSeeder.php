<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswas')->insert([
            [
                'nama' => 'Shelyna Riska Amanatullah',
                'nim' => '431672',
                'no_wa' => '087283192834',
                'created_at' => '2024-05-19 07:00:00',
                'updated_at' => '2024-05-19 07:00:00'
            ],
            [
                'nama' => 'Shendy Tria',
                'nim' => '431673',
                'no_wa' => '08123456723',
                'created_at' => '2024-05-19 07:00:00',
                'updated_at' => '2024-05-19 07:00:00'
            ],
        ]);
    }
}
