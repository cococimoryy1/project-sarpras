<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Menampilkan daftar barang yang tersedia untuk dipinjam
        $barangs = Barang::where('status', 'tersedia')->get();

        // Jika admin, tampilkan juga daftar peminjaman untuk persetujuan
        $peminjamanList = [];
        if (Auth::user()->role_id == 1) {
            $peminjamanList = Peminjaman::with(['user', 'details.barang'])
                ->where('status_peminjaman', 'pending')
                ->get();
        }

        return view('peminjaman.index', compact('barangs', 'peminjamanList'));
    }

    public function store(Request $request)
    {
        // Validasi input peminjaman
        $request->validate([
            'barang_id' => 'required|exists:barangs,barang_id',
            'jumlah_barang' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        // Membuat transaksi peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status_peminjaman' => 'dipinjam',  // Pastikan status adalah 'dipinjam'
        ]);

        // Menambahkan detail peminjaman
        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'barang_id' => $request->barang_id,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        // Update jumlah barang yang tersedia
        $barang = Barang::findOrFail($request->barang_id);
        $barang->jumlah_tersedia -= $request->jumlah_barang;
        $barang->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }


    public function accPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Cek apakah pengguna adalah admin
        if (Auth::user()->role_id == 1) {
            // Update status peminjaman
            $peminjaman->status_peminjaman = 'dipinjam'; // Setujui peminjaman
            $peminjaman->save();

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman disetujui.');
        }

        return redirect()->route('peminjaman.index')->with('error', 'Hanya admin yang bisa menyetujui peminjaman.');
    }

    public function tolakPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Cek apakah pengguna adalah admin
        if (Auth::user()->role_id == 1) {
            // Update status peminjaman
            $peminjaman->status_peminjaman = 'dibatalkan'; // Tolak peminjaman
            $peminjaman->save();

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman ditolak.');
        }

        return redirect()->route('peminjaman.index')->with('error', 'Hanya admin yang bisa menolak peminjaman.');
    }
}
