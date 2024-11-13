<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi; // Pastikan model Absensi diimpor
use App\Models\Nilai; // Pastikan model Nilai diimpor
use App\Models\JadwalKuliah;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class PerkuliahanController extends Controller
{
    public function jadwalkuliah()
    {
        $sb_menu = "perkuliahan";
        $sb_submenu = "jadwalkuliah";
        $jadwal_kuliahs = JadwalKuliah::all();
        return view('perkuliahan.jadwalkuliah', compact('sb_menu', 'sb_submenu', 'jadwal_kuliahs'));
    }


    public function simpanjadwal(Request $request)
    {
        // Validasi input
        $request->validate([
            'mata_kuliah' => 'required|string|max:255',
            'dosen_pengampu' => 'required|string|max:255',
            'ruang' => 'required|string|max:20',
            'hari' => 'required|string|max:10',
            'jam' => 'required|string|max:20',
        ]);

        // Simpan data ke dalam database menggunakan model JadwalKuliah
        JadwalKuliah::create([
            'mata_kuliah' => $request->mata_kuliah,
            'dosen_pengampu' => $request->dosen_pengampu,
            'ruang' => $request->ruang,
            'hari' => $request->hari,
            'jam' => $request->jam,
        ]);

        

        UserActivity::create([
            'user_id' => Auth::id(),
            'status' => 'SUCCESS',
            'method' => request()->route()->getActionName(),
            'function' => __FUNCTION__,
            'Deskripsi' => 'menambahkan jadwal kuliah baru',
        ]);


        // Redirect atau respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Data jadwal kuliah berhasil disimpan');
    }

    public function jadwal_ujian()
    {
        $sb_menu = "perkuliahan";
        $sb_submenu = "jadwal_ujian";
        return view('perkuliahan.jadwalujian', compact('sb_menu', 'sb_submenu'));
    }

    public function nilaimhs()
    {
        $sb_menu = "perkuliahan";
        $sb_submenu = "nilaimhs";

        $data = Nilai::all();
        return view('perkuliahan.nilaimhs', compact('sb_menu', 'sb_submenu', 'data'));
    }

    public function absensi_mhs()
    {
        $sb_menu = "perkuliahan";
        $sb_submenu = "absensi_mhs";

        $absensi = Absensi::all();
        return view('perkuliahan.absenmhs', compact('sb_menu', 'sb_submenu', 'absensi'));
    }

    public function store_absen(Request $request)
    {
        // Simpan data ke database
            Absensi::create([
                'mahasiswa' => $request->nama,
                'mata_kuliah' => $request->mata_kuliah,
                'status' => $request->status,
                'tanggal' => $request->tanggal,
            ]);

            UserActivity::create([
                'user_id' => Auth::id(),
                'status' => 'SUCCESS',
                'method' => request()->route()->getActionName(),
                'function' => __FUNCTION__,
                'Deskripsi' => $request->nim . 'melakukan absensi',
            ]);

            return redirect('perkuliahan-absensi_mhs')->with('success', 'Data absensi berhasil disimpan.');
    }

    public function simpanNilai(Request $request)
    {

            Nilai::create([
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'mata_kuliah' => $request->mata_kuliah,
                'nilai' => $request->nilai,
            ]);

            UserActivity::create([
                'user_id' => Auth::id(),
                'status' => 'SUCCESS',
                'method' => request()->route()->getActionName(),
                'function' => __FUNCTION__,
                'Deskripsi' => $request->nim . 'mendapatkan nilai ' . $request->nilai . ' di ' . $request->mata_kuliah,
            ]);

            return redirect('perkuliahan-nilaimahasiswa')->with('success', 'Nilai mahasiswa berhasil disimpan');
    }

    public function test_method()
    {
        return "Controller is working";
    }
}
