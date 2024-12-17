<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\KetersediaanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    // Menampilkan daftar pengembalian
    public function index()
    {
        // Inisialisasi variabel kosong
        $peminjamanList = collect(); // Default kosong
        $pengembalianList = collect(); // Default kosong
    
        if (Auth::user()->role_id == 1) {
            // Admin: Ambil semua pengembalian
            $pengembalianList = Pengembalian::with(['peminjaman.details.barang', 'peminjaman.user'])
                ->get();
        } else {
            // User: Ambil peminjaman miliknya yang memiliki pengembalian
            $peminjamanList = Peminjaman::with('details.barang')
                ->where('user_id', Auth::id())
                ->get();
        }
    
        return view('pengembalian.index', compact('pengembalianList', 'peminjamanList'));
    }
    

    // User mengajukan pengembalian
    public function store($peminjaman_id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($peminjaman_id);

        if ($peminjaman->status_peminjaman != 'dipinjam') {
            return redirect()->route('pengembalian.index')->with('error', 'Peminjaman ini tidak dapat dikembalikan.');
        }

        // Buat data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'tanggal_kembali' => now(),
            'status_pengembalian' => 'belum dikembalikan',
            'denda' => 0,
        ]);

        // Update status peminjaman
        $peminjaman->update(['status_peminjaman' => 'menunggu pengembalian']);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil diajukan.');
    }

    // Admin menyetujui pengembalian
    public function accPengembalian($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.details')->findOrFail($id);

        if ($pengembalian->status_pengembalian != 'belum dikembalikan') {
            return redirect()->route('pengembalian.index')->with('error', 'Pengembalian sudah diproses.');
        }

        // Kembalikan stok barang
        foreach ($pengembalian->peminjaman->details as $detail) {
            $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();
            if ($ketersediaan) {
                $ketersediaan->increment('jumlah_tersedia', $detail->jumlah_barang);
            }
        }

        // Update status pengembalian dan peminjaman
        $pengembalian->update(['status_pengembalian' => 'dikembalikan']);
        $pengembalian->peminjaman->update(['status_peminjaman' => 'selesai']);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil disetujui.');
    }
}
