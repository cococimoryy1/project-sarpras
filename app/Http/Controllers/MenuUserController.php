<?php

namespace App\Http\Controllers;

use App\Models\JenisUser;
use App\Models\JenisUserModel;
use App\Models\Menu;
use App\Models\MenuUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuUserController extends Controller
{
    public function index()
    {
        // $navbar = MenuUser::with('menu')->where('user_id', Auth::user()->id_jenis_user)->get();
        // return $navbar;
        $ppp = MenuUser::with('menu', 'jenisUser')->get();

        $menus = $ppp->groupBy('jenisUser.jenis_user');
        $allMenu = Menu::all();
        $jenis_user = JenisUser::all();

        return view('menu.index', compact('menus', 'allMenu', 'jenis_user', 'ppp'));
    }

    // public function showLink($menu_name){

    //     $halaman = Menu::user

    // }

    public function store(Request $request)
    {

        $data = [
            'user_id' => $request->user_id,
            'menu_id' => $request->menu_id,
        ];

        // return $data;    

        MenuUser::create($data);

        return redirect()->back()->with('success', 'Berhasil Ditambahkan');

    }
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->menu_name = $request->menu_name;
        $menu->menu_link = $request->menu_link;
        $menu->menu_icon = $request->menu_icon;
        $menu->save();

        return response()->json(['status' => 'success']);
    }

    public function delete($id)
    {
        $data = MenuUser::find($id);
        $data->delete();

        return redirect('AksesMenu');
    }
}
