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
    // public function index()
    // {
    //     $user = auth()->user();

    //     // Cek jika user null
    //     if (!$user) {
    //         return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    //     }

    //     $roleId = $user->role_id;

    //     // Ambil menu berdasarkan akses role pengguna
    //     $menus = \App\Models\Akses::where('role_id', $roleId)
    //                               ->where('hak_akses', 'like', '%lihat%') // Menampilkan menu yang ada hak akses "lihat"
    //                               ->get();

    //     return view('dashboard', compact('menus'));
    // }

    // // app/Http/Controllers/DashboardController.php

// public function showDashboard()
// {
//     $menus = (new MenuController())->getAccessibleMenus(); // Mendapatkan menu yang bisa diakses
//     return view('dashboard', compact('menus'));
// }

// public function getWeather()
// {
//     $url = "https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-JawaTimur.xml";

//     $client = new \GuzzleHttp\Client();
//     $response = $client->get($url);

//     return response($response->getBody(), 200)
//         ->header('Content-Type', 'application/xml');
// }

}

