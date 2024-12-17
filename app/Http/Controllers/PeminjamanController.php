<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Barang;
use App\Models\KetersediaanBarang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // Menampilkan halaman utama peminjaman
    public function index()
{
    // Ambil data barang untuk user (role_id = 2)
    $barangs = Barang::with('kategori', 'ketersediaan')->get();

    // Ambil daftar peminjaman untuk admin
    $peminjamanList = [];
    if (Auth::user()->role_id == 1) {
        $peminjamanList = Peminjaman::with(['user', 'details.barang'])
            ->whereIn('status_peminjaman', ['pending', 'dipinjam']) // Menampilkan status pending dan dipinjam
            ->get();
    }

    return view('peminjaman.index', compact('barangs', 'peminjamanList'));
}


    // Menyimpan permintaan peminjaman
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'barang_id' => 'required|exists:barangs,barang_id',
            'jumlah_barang' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        // Menghitung total hari
        $tanggal_pinjam = Carbon::parse($request->tanggal_pinjam);
        $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
        $total_hari = $tanggal_pinjam->diffInDays($tanggal_kembali);

        // Membuat data peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status_peminjaman' => 'pending',
            'total_hari' => $total_hari,
        ]);

        // Tambahkan detail peminjaman
        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'barang_id' => $request->barang_id,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan dan menunggu persetujuan.');
    }

    // Menyetujui peminjaman
    public function accPeminjaman($id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($id);
    
        if (Auth::user()->role_id == 1) {
            if ($peminjaman->status_peminjaman != 'pending') {
                return redirect()->route('peminjaman.index')->with('error', 'Peminjaman sudah diproses sebelumnya.');
            }
    
            foreach ($peminjaman->details as $detail) {
                $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();
    
                if ($ketersediaan && $ketersediaan->jumlah_tersedia >= $detail->jumlah_barang) {
                    $ketersediaan->decrement('jumlah_tersedia', $detail->jumlah_barang);
                } else {
                    return redirect()->route('peminjaman.index')->with('error', 'Stok barang tidak mencukupi.');
                }
            }
    
            // Update status menjadi 'dipinjam'
            $peminjaman->update(['status_peminjaman' => 'dipinjam']);
    
            // Buat data pengembalian
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->peminjaman_id,
                'tanggal_kembali' => $peminjaman->tanggal_kembali,
                'status_pengembalian' => 'belum dikembalikan',
                'denda' => 0,
            ]);
    
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disetujui.');
        }
    
        return redirect()->route('peminjaman.index')->with('error', 'Hanya admin yang bisa menyetujui peminjaman.');
    }
    
    // Menolak peminjaman
    public function tolakPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        if (Auth::user()->role_id == 1 && $peminjaman->status_peminjaman == 'pending') {
            $peminjaman->update(['status_peminjaman' => 'dibatalkan']);
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditolak.');
        }
        return redirect()->route('peminjaman.index')->with('error', 'Gagal menolak peminjaman.');
    }

    // Menampilkan detail peminjaman
    public function showDetail($id)
    {
        $peminjaman = Peminjaman::with(['details.barang', 'user'])->findOrFail($id);
        return view('peminjaman.detail', compact('peminjaman'));
    }
}
