<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Barang; // Pastikan pakai Category, bukan Kategori


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = Category::create([
            'id_kategori' => 1,
            'nama_kategori' => 'Peralatan Rumah Tangga',
        ]);

        // Buat barang setelah kategori ada
        Barang::create([
            'nama_barang' => 'Kursi',
            'deskripsi_barang' => 'Kursi kayu',
            'kategori_barang_id' => $kategori->id_kategori, // PASTIKAN SESUAI
            'jumlah_total' => 40,
            'status' => 'tersedia',
        ]);
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
