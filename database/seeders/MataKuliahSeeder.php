<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan DB facade diimport

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matakuliah')->insert([
            ['idmatakuliah' => '4095', 'nama_mk' => 'Pemograman Framework'],
            ['idmatakuliah' => '4096', 'nama_mk' => 'Basis Data']
        ]);
    }
}
