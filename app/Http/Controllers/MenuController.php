<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

     // Menampilkan semua menu
     public function index()
     {
         // Ambil semua menu, termasuk struktur hierarki
         $menus = Menu::with('children')->whereNull('parent_id')->get();
         return view('menus.index', compact('menus'));
     }

     // Menampilkan form untuk membuat menu baru
     public function create()
     {
         // Ambil semua menu utama untuk opsi parent
         $parentMenus = Menu::whereNull('parent_id')->get();
         return view('menus.create', compact('parentMenus'));
     }

     // Menyimpan menu baru
     public function store(Request $request)
     {
         $request->validate([
             'nama_menu' => 'required|string|max:100',
             'deskripsi_menu' => 'nullable|string|max:255',
             'link' => 'nullable|string|max:255',
             'parent_id' => 'nullable|exists:menus,id', // Validasi parent_id harus valid
         ]);

         Menu::create($request->all());

         return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan!');
     }

     // Menampilkan form untuk mengedit menu
     public function edit(Menu $menu)
     {
         // Ambil semua menu utama untuk opsi parent
         $parentMenus = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
         return view('menus.edit', compact('menu', 'parentMenus'));
     }

     // Memperbarui menu
     public function update(Request $request, Menu $menu)
     {
         $request->validate([
             'nama_menu' => 'required|string|max:100',
             'deskripsi_menu' => 'nullable|string|max:255',
             'link' => 'nullable|string|max:255',
             'parent_id' => 'nullable|exists:menus,id',
         ]);

         $menu->update($request->all());

         return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui!');
     }

     // Menghapus menu
     public function destroy(Menu $menu)
     {
         $menu->delete();
         return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
     }

//      public function getMenusForSidebar()
// {
//     $userRole = auth()->user()->role_id;

//     $menus = Menu::with('children')
//         ->whereHas('akses', function ($query) use ($userRole) {
//             $query->where('role_id', $userRole)->where('hak_akses', 'lihat');
//         })
//         ->whereNull('parent_id') // Hanya menu utama
//         ->get();

//     return $menus;
// }

// Menampilkan semua menu
//    // Menampilkan semua menu
//    public function index()
//    {
//        $menus = Menu::all();
//        return view('menus.index', compact('menus'));
//    }

//    // Menampilkan form untuk membuat menu baru
//    public function create()
//    {
//        return view('menus.create');
//    }

//    // Menyimpan menu baru
//    public function store(Request $request)
//    {
//        // Validasi input
//        $request->validate([
//            'nama_menu' => 'required|string|max:100',
//            'deskripsi_menu' => 'nullable|string|max:255',
//        ]);

//        // Menyimpan data menu
//        Menu::create($request->all());

//        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan!');
//    }

//    // Menampilkan form untuk mengedit menu
//    public function edit(Menu $menu)
//    {
//        return view('menus.edit', compact('menu'));
//    }

//    // Memperbarui menu
//    public function update(Request $request, Menu $menu)
//    {
//        // Validasi input
//        $request->validate([
//            'nama_menu' => 'required|string|max:100',
//            'deskripsi_menu' => 'nullable|string|max:255',
//        ]);

//        // Memperbarui data menu
//        $menu->update($request->all());

//        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui!');
//    }

//    // Menghapus menu
//    public function destroy(Menu $menu)
//    {
//        $menu->delete();
//        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
//    }
//    public function getMenusForUser()
//    {
//        $userRole = auth()->user()->role_id;

//        // Pastikan role_id ada dan valid
//        if ($userRole) {
//            $menus = Menu::whereHas('akses', function ($query) use ($userRole) {
//                $query->where('role_id', $userRole); // Filter menu berdasarkan role_id
//            })->get();

//            return view('menus.index', compact('menus'));
//        }

//        // Jika tidak ada role_id
//        return redirect()->route('home')->with('error', 'Role pengguna tidak ditemukan!');
//    }



}
