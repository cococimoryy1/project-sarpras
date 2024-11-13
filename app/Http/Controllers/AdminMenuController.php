<?php

namespace App\Http\Controllers;

use App\Models\MenuUser;
use App\Models\MenuLevel;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\JenisUser;

class AdminMenuController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::with(['hasRole', 'menus'])->get();
        $menus = Menu::all();
        $menu_levels = MenuLevel::all();
        $jenis_users = JenisUser::all();
        return view('settingmenu.index', compact('user', 'menu_users', 'menus', 'menu_levels', 'jenis_users'));
    }


    public function create()
    {
        $user = auth()->user();
        $menus = Menu::all();
        $menu_users = MenuUser::all();
        $menu_levels = MenuLevel::all();
        $user_photos = $user->user_photos;
        return view('menu.create', compact('menus', 'menu_users', 'user', 'menu_levels', 'user_photos'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_level' => 'required',
            'create_by' => 'required',
            'menu_name' => 'required|max:20',
            'menu_link' => 'required',
            'menu_icon' => 'required'
        ]);

        Menu::create($validatedData);

        return redirect('/dashboard/menu')->with('success', 'New menu has been added!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_level' => 'required',
            'create_by' => 'required',
            'menu_name' => 'required|max:20',
            'menu_link' => 'required',
            'menu_icon' => 'required'
        ]);

        $menu = Menu::find($request->menu_id);

        if ($menu) {
            $menu->id_level = $request->id_level;
            $menu->create_by = $request->create_by;
            $menu->menu_name = $request->menu_name;
            $menu->menu_link = $request->menu_link;
            $menu->menu_icon = $request->menu_icon;
            $menu->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Menu not found.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implement logic to show a specific menu if needed
    }

    public function edit(string $id)
    {
        // Implement logic to edit a specific menu if needed
    }

    public function destroy($menu_id)
    {
        $menu = Menu::find($menu_id);

        if ($menu) {
            $menu->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Menu not found.']);
    }
}
