<?php

namespace App\Http\Controllers;

use App\Models\ManajemenPeminjaman;
use App\Models\Peminjaman;
use App\Models\KetersediaanBarang;
use Illuminate\Http\Request;

class ManajemenPeminjamanController extends Controller
{
    public function index()
    {
        $peminjamanList = Peminjaman::with('user', 'details.barang')
            ->where('status_peminjaman', 'pending')
            ->get();
        return view('manajemen_peminjaman.index', compact('peminjamanList'));
    }

    public function terima($id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($id);

        // Update status peminjaman dan stok barang
        foreach ($peminjaman->details as $detail) {
            $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();
            if ($ketersediaan->jumlah_tersedia >= $detail->jumlah_barang) {
                $ketersediaan->decrement('jumlah_tersedia', $detail->jumlah_barang);
            } else {
                return redirect()->route('manajemen_peminjaman.index')->with('error', 'Stok barang tidak cukup.');
            }
        }

        // Setujui peminjaman
        $peminjaman->update(['status_peminjaman' => 'dipinjam']);

        // Buat entri manajemen peminjaman
        ManajemenPeminjaman::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'status' => 'diterima',
            'tanggal_diterima' => now(),
        ]);

        return redirect()->route('manajemen_peminjaman.index')->with('success', 'Peminjaman diterima dan stok diperbarui.');
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status_peminjaman' => 'ditolak']);

        // Buat entri manajemen peminjaman
        ManajemenPeminjaman::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'status' => 'ditolak',
            'tanggal_diterima' => now(),
        ]);

        return redirect()->route('manajemen_peminjaman.index')->with('success', 'Peminjaman ditolak.');
    }
}
