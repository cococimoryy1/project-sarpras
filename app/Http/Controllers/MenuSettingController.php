<?php

namespace App\Http\Controllers;

use App\Models\JenisUser;
use App\Models\menu;
use Illuminate\Http\Request;
use App\Models\User;

class MenuSettingController extends Controller
{
    // Menampilkan semua menu
    public function index()
    {
        // Menampilkan semua menu tanpa relasi parent
        $menus = menu::all();
        $jenis_user = JenisUser::all();
        $allMenu = menu::all();
        return view('menu.index', compact('menus', 'jenis_user', 'allMenu'));
    }

    // Form tambah menu
    public function create()
    {
        return view('menu.create');
    }

    // Simpan menu baru
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input tanpa parent_id
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_link' => 'required|string|max:255',
            'menu_icon' => 'nullable|string|max:255',
            'menuLevels_id' => 'required|integer',
          // Mengubah menjadi string jika menyimpan nama icon
        ]);

        // Menyimpan data menu baru
        menu::create($request->only(['menu_name', 'menu_link', 'menu_icon','menuLevels_id']));
        // $menus = menu::all();
        return redirect('AksesMenu');
    }

    // Form edit menu
    public function edit($id)
    {
        // Ambil menu berdasarkan id
        $menu = Menu::findOrFail($id);

        return view('menu.edit', compact('menu'));
    }

    // Update menu yang ada
    public function update(Request $request, $id)
    {
        // Validasi input tanpa parent_id
        // $request->validate([
        //     'menu_name' => 'required|string',
        //     'menu_link' => 'required|string',
        //     'menu_icon' => 'nullable|string', // Mengubah menjadi string jika menyimpan nama icon
        // ]);

        // Ambil menu berdasarkan id dan update
        $menu = menu::findOrFail($id);
        $menu->menu_name = $request->menu_name;
        $menu->menu_link = $request->menu_link;
        $menu->menu_icon = $request->menu_icon;
        $menu->save();

        // $menu->update($request->only(['menu_name', 'menu_link', 'menu_icon']));

        return redirect('AksesMenu')->with('success', 'Menu berhasil diperbarui!');
    }

    // Hapus menu
    public function delete($id)
    {
        // Ambil menu berdasarkan id dan hapus
        $menu = menu::findOrFail($id);
        $menu->delete();

        return redirect('AksesMenu')->with('success', 'Menu berhasil dihapus!');
    }
    public function getUserMenus($userId)
    {
        // Mengambil user beserta jenis_user terkait
        $user = User::with('jenis_user')->findOrFail($userId); // Mengambil user dengan relasi jenis_user

        if ($user->jenis_user) {
            // Jika jenis_user ditemukan, ambil id_jenis_user
            $roleId = $user->id_jenis_user;
        } else {
            // Jika jenis_user tidak ditemukan, redirect dengan error
            return redirect()->back()->with('error', 'Jenis user tidak ditemukan');
        }

        // Mengambil menu berdasarkan role/jenis user
        $menus = menu::whereIn('id', function($query) use ($roleId) {
            $query->select('menu_id')
                  ->from('menu_levels')
                  ->where('jenis_user_id', $roleId);
        })->get();

        // Menampilkan view dashboard dengan menu yang sesuai untuk user
        return view('dashboard', compact('menus'));
    }



}
