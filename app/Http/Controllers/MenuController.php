<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
// Menampilkan semua menu
   // Menampilkan semua menu
   public function index()
   {
       $menus = Menu::all();
       return view('menus.index', compact('menus'));
   }

   // Menampilkan form untuk membuat menu baru
   public function create()
   {
       return view('menus.create');
   }

   // Menyimpan menu baru
   public function store(Request $request)
   {
       // Validasi input
       $request->validate([
           'nama_menu' => 'required|string|max:100',
           'deskripsi_menu' => 'nullable|string|max:255',
       ]);

       // Menyimpan data menu
       Menu::create($request->all());

       return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan!');
   }

   // Menampilkan form untuk mengedit menu
   public function edit(Menu $menu)
   {
       return view('menus.edit', compact('menu'));
   }

   // Memperbarui menu
   public function update(Request $request, Menu $menu)
   {
       // Validasi input
       $request->validate([
           'nama_menu' => 'required|string|max:100',
           'deskripsi_menu' => 'nullable|string|max:255',
       ]);

       // Memperbarui data menu
       $menu->update($request->all());

       return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui!');
   }

   // Menghapus menu
   public function destroy(Menu $menu)
   {
       $menu->delete();
       return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
   }
}
