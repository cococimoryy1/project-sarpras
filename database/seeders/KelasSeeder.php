<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan DB facade diimport

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'idkelas' => '2323',
                'nama_kelas' => 'EK-2.28'
            ],
            [
                'idkelas' => '2525',
                'nama_kelas' => 'GKB 3.07'
            ]
        ]);
    }
}
