<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
    //     $user = auth()->user();
            return view('dashboard');

    }
    // app/Http/Controllers/DashboardController.php

public function showDashboard()
{
    $menus = (new MenuController())->getAccessibleMenus(); // Mendapatkan menu yang bisa diakses
    return view('dashboard', compact('menus'));
}

}

