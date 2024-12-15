<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AksesSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama untuk menghindari duplikasi
        // DB::table('akses')->truncate();

        DB::table('akses')->insert([
            // Akses untuk Admin
            [
                'role_id' => 1, // Admin
                'menu_id' => 1, // Dashboard
                'hak_akses' => 'lihat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 2, // Role
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 3, // User
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 4, // Kategori Barang
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 5, // Master Barang
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 6, // Master Menu
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 7, // Kelola Akses Menu
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 8, // Manajemen Peminjaman
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 1,
                'menu_id' => 9, // Manajemen Pengembalian
                'hak_akses' => 'lihat,tambah,ubah,hapus',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Akses untuk User
            [
                'role_id' => 2, // User
                'menu_id' => 1, // Dashboard
                'hak_akses' => 'lihat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'menu_id' => 8, // Peminjaman
                'hak_akses' => 'lihat,tambah', // Bisa mengajukan peminjaman
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'menu_id' => 9, // Pengembalian
                'hak_akses' => 'lihat,tambah', // Bisa mengajukan pengembalian
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
