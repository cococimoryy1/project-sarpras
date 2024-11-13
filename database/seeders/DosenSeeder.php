<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dosen')->insert([
            [
                'nama' => 'Fitri',
                'nip' => '431624',  // Gantilah nim dengan nip jika dosen menggunakan nip
                'no_wa' => '087283192822',
                'created_at' => '2024-05-19 07:00:00',
                'updated_at' => '2024-05-19 07:00:00'
            ],
            [
                'nama' => 'Armand',
                'nip' => '431625',  // Gantilah nim dengan nip jika dosen menggunakan nip
                'no_wa' => '08123456755',
                'created_at' => '2024-05-19 07:00:00',
                'updated_at' => '2024-05-19 07:00:00'
            ],
        ]);
    }
}
