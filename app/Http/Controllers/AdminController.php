<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Menampilkan daftar peminjaman yang belum disetujui atau ditolak
        $peminjaman = Peminjaman::with('details.barang')->where('status_peminjaman', 'dipinjam')->get();
        return view('admin.index', compact('peminjaman'));
    }

    public function updateStatus($id, $status)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status_peminjaman = $status;
        $peminjaman->save();

        // Jika peminjaman disetujui, update status barang menjadi dipinjam
        if ($status == 'selesai') {
            foreach ($peminjaman->details as $detail) {
                $barang = $detail->barang;
                $barang->jumlah_tersedia -= $detail->jumlah_barang;
                $barang->save();
            }
        } else if ($status == 'dibatalkan') {
            foreach ($peminjaman->details as $detail) {
                $barang = $detail->barang;
                $barang->jumlah_tersedia += $detail->jumlah_barang;
                $barang->save();
            }
        }

        return redirect()->route('admin.index')->with('success', 'Status peminjaman telah diperbarui.');
    }
}
