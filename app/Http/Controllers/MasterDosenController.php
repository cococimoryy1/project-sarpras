<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterDosen; // Sesuaikan dengan model MasterDosen yang sesuai
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class MasterDosenController extends Controller
{

    public function index()
    {
        $dosens = MasterDosen::all(); // Mengambil semua data dosen dari model MasterDosen

        // Mengirimkan data dosens ke view master.masterdosen
        return view('master.masterdosen', compact('dosens'));
    }

    public function masterDosen()
    {
        $sb_menu = "mahasiswa";
        $sb_submenu = "masterdosen";

        // Mengambil semua data dosen dari tabel master_dosens menggunakan model MasterDosen
        $dosens = MasterDosen::all();

        // Mengirimkan data dosens ke view master.masterdosen
        return view('master.masterdosen', compact('sb_menu', 'sb_submenu', 'dosens'));
    }

    public function simpanMasterDosen(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_dosen' => 'required|string|max:20',
            'nama_dosen' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Simpan data ke dalam database menggunakan model MasterDosen
        MasterDosen::create([
            'kode_dosen' => $request->kode_dosen,
            'nama_dosen' => $request->nama_dosen,
            'email' => $request->email,
        ]);

        UserActivity::create([
            'user_id' => Auth::id(),
            'status' => 'SUCCESS',
            'method' => request()->route()->getActionName(),
            'function' => __FUNCTION__,
            'Deskripsi' => 'menambahkan dosen baru',
        ]);

        // Mengambil kembali data dosen setelah disimpan
        $dosens = MasterDosen::all();

        // Redirect atau respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Data master dosen berhasil disimpan')->with(compact('dosens'));
    }
}
