<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KetersediaanBarang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            // Admin: Ambil semua pengembalian yang menunggu persetujuan
            $pengembalianList = Pengembalian::with(['peminjaman', 'peminjaman.details.barang', 'peminjaman.user'])
                ->whereHas('peminjaman', function ($query) {
                    $query->where('status_peminjaman', 'menunggu pengembalian');
                })
                ->get();

            return view('pengembalian.index', compact('pengembalianList'));
        } else {
            // User: Ambil data peminjaman miliknya
            $peminjamanList = Peminjaman::with(['details.barang'])
                ->where('user_id', Auth::id())
                ->get();

            return view('pengembalian.index', compact('peminjamanList'));
        }
    }


    public function store(Request $request, $peminjaman_id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($peminjaman_id);

        // Pastikan status peminjaman adalah 'dipinjam'
        if ($peminjaman->status_peminjaman != 'dipinjam') {
            return redirect()->route('pengembalian.index')->with('error', 'Peminjaman ini tidak bisa dikembalikan.');
        }

        // Hitung denda (jika ada keterlambatan)
        $today = now();
        $tanggal_kembali = $peminjaman->tanggal_kembali;
        $denda = 0;

        if ($today->gt($tanggal_kembali)) {
            $hari_terlambat = $today->diffInDays($tanggal_kembali);
            $denda = $hari_terlambat * 10000; // Misalnya, denda Rp10.000 per hari
        }

        // Buat data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $peminjaman_id,
            'tanggal_kembali' => $today, // Tanggal saat pengembalian diajukan
            'status_pengembalian' => 'belum dikembalikan',
            'denda' => $denda,
        ]);

        // Update status peminjaman menjadi 'menunggu pengembalian'
        $peminjaman->status_peminjaman = 'menunggu pengembalian';
        $peminjaman->save();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian telah diajukan, menunggu persetujuan admin.');
    }



    public function accPengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        // Pastikan status pengembalian 'belum dikembalikan'
        if ($pengembalian->status_pengembalian != 'belum dikembalikan') {
            return redirect()->route('pengembalian.index')->with('error', 'Pengembalian sudah diproses.');
        }

        // Proses setujui pengembalian
        $pengembalian->status_pengembalian = 'dikembalikan';
        $pengembalian->save();

        // Update status peminjaman dan stok barang
        $peminjaman = $pengembalian->peminjaman;
        $peminjaman->status_peminjaman = 'selesai';
        $peminjaman->save();

        foreach ($peminjaman->details as $detail) {
            $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();
            if ($ketersediaan) {
                $ketersediaan->jumlah_tersedia += $detail->jumlah_barang;
                $ketersediaan->save();
            }
        }

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil disetujui.');
    }


}
