<?php

namespace App\Http\Controllers;

use App\Models\ManajemenPengembalian;
use App\Models\Pengembalian;
use App\Models\KetersediaanBarang;
use Illuminate\Http\Request;

class ManajemenPengembalianController extends Controller
{
    public function index()
    {
        $pengembalianList = Pengembalian::with(['peminjaman', 'peminjaman.details.barang'])
            ->where('status_pengembalian', 'belum dikembalikan')
            ->get();
        return view('manajemen_pengembalian.index', compact('pengembalianList'));
    }

    public function setuju($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        // Update status pengembalian
        $pengembalian->update(['status_pengembalian' => 'selesai']);

        // Update status peminjaman dan stok barang
        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->update(['status_peminjaman' => 'selesai']);

        foreach ($peminjaman->details as $detail) {
            $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();
            if ($ketersediaan) {
                $ketersediaan->increment('jumlah_tersedia', $detail->jumlah_barang);
            }
        }

        // Buat entri manajemen pengembalian
        ManajemenPengembalian::create([
            'pengembalian_id' => $pengembalian->pengembalian_id,
            'status' => 'selesai',
            'tanggal_selesai' => now(),
        ]);

        return redirect()->route('manajemen_pengembalian.index')->with('success', 'Pengembalian diterima dan stok diperbarui.');
    }
}
