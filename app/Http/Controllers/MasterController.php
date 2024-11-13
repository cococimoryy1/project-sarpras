<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\MasterMK;
use App\Models\MasterKelas;
use App\Models\MasterDosen;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    public function mastermhs()
    {
        $sb_menu = "mahasiswa";
        $sb_submenu = "mastermahasiswa";

        if (!session()->has('mahasiswa')) {
            session()->put('mahasiswa', array());
        }

        $mahasiswa = Mahasiswa::all();
        session()->flash('notif', 'Mahasiswa berhasil ditambahkan');

        return view('master.mastermahasiswa', compact('sb_menu', 'sb_submenu', 'mahasiswa'));
    }
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function masterMK()
    {
        $sb_menu = "mahasiswa";
        $sb_submenu = "masterMK";

        // Mengambil semua data dari tabel master_mk menggunakan model MasterMK
        $masterMK = MasterMK::all();

        return view('master.masterMK', compact('sb_menu', 'sb_submenu', 'masterMK'));
    }

    public function simpanMasterMK(Request $request)
    {

        // Simpan data ke dalam database menggunakan model MasterMK
        MasterMK::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
        ]);

        UserActivity::create([
            'user_id' => Auth::id(),
            'status' => 'SUCCESS',
            'method' => request()->route()->getActionName(),
            'function' => __FUNCTION__,
            'Deskripsi' => 'menambahkan mata kuliah baru',
        ]);

        // Redirect atau respons sesuai kebutuhan aplikasi Anda
        return redirect('master-MK')->with('success', 'Data master mata kuliah berhasil disimpan');
    }

    public function masterkelas()
    {
        $sb_menu = "master";
        $sb_submenu = "kelas";
        $kelas = MasterKelas::all();
        return view('master.masterkelas', compact('sb_menu', 'sb_submenu', 'kelas'));
    }

    public function simpanMasterKelas(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_kelas' => 'required|string|max:20',
            'nama_kelas' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        try {
            MasterKelas::create([
                'kode_kelas' => $request->kode_kelas,
                'nama_kelas' => $request->nama_kelas,
            ]);

            UserActivity::create([
                'user_id' => Auth::id(),
                'status' => 'SUCCESS',
                'method' => request()->route()->getActionName(),
                'function' => __FUNCTION__,
                'Deskripsi' => 'menambahkan kelas baru',
            ]);

            return redirect()->back()->with('success', 'Data kelas berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteMasterKelas($id)
    {
        try {
            $kelas = MasterKelas::findOrFail($id);
            $kelas->delete();
            return redirect()->back()->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // public function masterDosen()
    // {
    //     $sb_menu = "mahasiswa";
    //     $sb_submenu = "masterdosen";

    //     // Mengambil semua data dosen dari tabel master_dosen menggunakan model MasterDosen
    //     $dosens = MasterDosen::all();

    //     return view('master.masterdosen', compact('sb_menu', 'sb_submenu', 'dosens'));
    // }

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

        // Redirect atau respons sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Data master dosen berhasil disimpan');
    }

    public function submitMahasiswa(Request $request)
    {
        $mhs = new Mahasiswa;
        $mhs->nama = $request->nama;
        $mhs->nim = $request->nim;
        $mhs->save();

        UserActivity::create([
            'user_id' => Auth::id(),
            'status' => 'SUCCESS',
            'method' => request()->route()->getActionName(),
            'function' => __FUNCTION__,
            'Deskripsi' => 'menambahkan mahasiswa baru',
        ]);

        return redirect()->route('mastermhs')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            return view('master.editmhs', compact('mahasiswa'));
        }
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            $mahasiswa->update($request->all());
            UserActivity::create([
                'user_id' => Auth::id(),
                'status' => 'SUCCESS',
                'method' => request()->route()->getActionName(),
                'function' => __FUNCTION__,
                'Deskripsi' => 'mengupdate data mahasiswa',
            ]);
            return redirect()->route('mastermhs')->with('success', 'Data mahasiswa berhasil diupdate.');
        }
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }
}
