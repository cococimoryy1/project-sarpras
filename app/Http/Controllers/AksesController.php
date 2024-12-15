<?php

// app/Http/Controllers/AksesController.php
namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class AksesController extends Controller
{
    // Menampilkan halaman kelola aksespublic function index()
    public function index()
    {
        $akses = Akses::with('role', 'menu')->get(); // Ambil data akses dengan relasi
        $roles = Role::all();
        $menus = Menu::all();
        // dd($akses);

        return view('akses.index', compact('akses', 'roles', 'menus'));
    }




    // Menyimpan pengaturan akses baru
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Menggunakan 'id' bukan 'role_id'
            'menu_id' => 'required|exists:menus,id', // Menggunakan 'id' bukan 'menu_id'
            'hak_akses' => 'required|in:lihat,tambah,ubah,hapus',
        ]);

        Akses::create($request->all());

        return redirect()->route('akses.index')->with('success', 'Akses menu berhasil ditambahkan.');
    }


    // Menghapus akses
    public function destroy(Akses $akses)
    {
        $akses->delete();
        return redirect()->route('akses.index')->with('success', 'Akses menu berhasil dihapus.');
    }


}


