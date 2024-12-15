<?php

// app/Http/Controllers/AksesController.php

namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;

class AksesController extends Controller
{
    // Menampilkan form untuk mengatur akses menu
    public function create(Menu $menu)
    {
        // Ambil semua role yang ada
        $roles = Role::all();
                $roles = Role::all();


        return view('akses.create', compact('menu', 'roles'));
    }

    // Menyimpan pengaturan akses menu
    public function store(Request $request, Menu $menu)
    {
        // Validasi input
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Validasi role yang dipilih
            'hak_akses' => 'required|in:lihat,tambah,ubah,hapus',
        ]);

        // Menyimpan akses untuk menu
        Akses::create([
            'role_id' => $request->role_id,
            'menu_id' => $menu->id,
            'hak_akses' => $request->hak_akses,
        ]);

        return redirect()->route('menus.index')->with('success', 'Akses menu berhasil diatur!');
    }
}
