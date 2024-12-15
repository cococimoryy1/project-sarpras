<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // DB::table('menus')->truncate();
        DB::table('menus')->insert([
            [
                'nama_menu' => 'Dashboard',
                'deskripsi_menu' => 'Halaman utama sistem',
                'link' => '/dashboard',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Role',
                'deskripsi_menu' => 'Manajemen role',
                'link' => '/roles',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'User',
                'deskripsi_menu' => 'Manajemen pengguna',
                'link' => '/users',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Kategori Barang',
                'deskripsi_menu' => 'Manajemen kategori barang',
                'link' => '/kategori',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Master Barang',
                'deskripsi_menu' => 'Manajemen data barang',
                'link' => '/barangs',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Master Menu',
                'deskripsi_menu' => 'Manajemen menu sistem',
                'link' => '/menus',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Kelola Akses Menu',
                'deskripsi_menu' => 'Pengaturan akses menu berdasarkan role',
                'link' => '/akses',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Manajemen Peminjaman',
                'deskripsi_menu' => 'Kelola peminjaman barang',
                'link' => '/peminjaman',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Manajemen Pengembalian',
                'deskripsi_menu' => 'Kelola pengembalian barang',
                'link' => '/pengembalian',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
