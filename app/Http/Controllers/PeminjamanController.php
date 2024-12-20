<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KetersediaanBarang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Ambil data barang dengan relasi kategori dan ketersediaan
        $barangs = Barang::with('kategori', 'ketersediaan')->get();

        // Ambil daftar peminjaman hanya jika user adalah admin (role_id == 1)
        $peminjamanList = [];
        if (Auth::user()->role_id == 1) {
            $peminjamanList = Peminjaman::with(['user', 'details.barang'])
                ->whereIn('status_peminjaman', ['pending']) // Ambil peminjaman yang pending dan dipinjam
                ->get();
        }

        // Jika user adalah user (role_id == 2), tampilkan daftar peminjaman mereka yang berstatus pending atau dipinjam
        $userPeminjamanList = [];
        if (Auth::user()->role_id == 2) {
            $userPeminjamanList = Peminjaman::with(['details.barang'])
                ->where('user_id', Auth::id()) // Ambil peminjaman milik user yang sedang login
                ->whereIn('status_peminjaman', ['pending', 'dipinjam']) // Status peminjaman yang pending atau dipinjam
                ->get();
        }

        // Kirim data barang dan peminjaman ke view
        return view('peminjaman.index', compact('barangs', 'peminjamanList', 'userPeminjamanList'));
    }



    public function store(Request $request)
    {
        // Validasi input peminjaman
        $request->validate([
            'barang_id' => 'required|exists:barangs,barang_id',
            'jumlah_barang' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // Hitung total hari berdasarkan tanggal_pinjam dan tanggal_kembali
        $tanggal_pinjam = Carbon::parse($request->tanggal_pinjam);
        $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
        $total_hari = $tanggal_pinjam->diffInDays($tanggal_kembali);
        if ($total_hari == 0) {
            $total_hari = 1; // Jika tanggal sama, set ke 1 hari
        }

        // Membuat transaksi peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status_peminjaman' => 'pending', // Status awal adalah pending
            'total_hari' => $total_hari,
        ]);

        // Menambahkan detail peminjaman
        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->peminjaman_id,
            'barang_id' => $request->barang_id,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan dan menunggu persetujuan.');
    }



    public function accPeminjaman($id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($id);

        if (Auth::user()->role_id == 1) {
            // Pastikan statusnya masih pending
            if ($peminjaman->status_peminjaman != 'pending') {
                return redirect()->route('peminjaman.index')->with('error', 'Peminjaman sudah diproses sebelumnya.');
            }

            // Kurangi jumlah barang di tabel ketersediaan_barang
            foreach ($peminjaman->details as $detail) {
                $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();

                if ($ketersediaan && $ketersediaan->jumlah_tersedia >= $detail->jumlah_barang) {
                    $ketersediaan->jumlah_tersedia -= $detail->jumlah_barang;
                    $ketersediaan->tanggal_terakhir_update = now();
                    $ketersediaan->save();
                } else {
                    return redirect()->route('peminjaman.index')->with('error', 'Stok barang tidak mencukupi.');
                }
            }

            // Update status peminjaman menjadi 'dipinjam'
            $peminjaman->status_peminjaman = 'dipinjam';
            $peminjaman->save();

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disetujui.');
        }

        return redirect()->route('peminjaman.index')->with('error', 'Hanya admin yang bisa menyetujui peminjaman.');
    }



    public function tolakPeminjaman($id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($id);

        if (Auth::user()->role_id == 1) {
            if ($peminjaman->status_peminjaman != 'pending') {
                return redirect()->route('peminjaman.index')->with('error', 'Peminjaman ini sudah diproses.');
            }

            // Update status peminjaman menjadi 'dibatalkan'
            $peminjaman->status_peminjaman = 'dibatalkan';
            $peminjaman->save();

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditolak.');
        }

        return redirect()->route('peminjaman.index')->with('error', 'Hanya admin yang bisa menolak peminjaman.');
    }

    public function return(Request $request, $id)
{
    $peminjaman = Peminjaman::with('details')->findOrFail($id);

    // Pastikan hanya admin yang bisa memproses pengembalian
    if (Auth::user()->role_id != 1) {
        return redirect()->route('peminjaman.index')->with('error', 'Hanya admin yang dapat memproses pengembalian.');
    }

    // Pastikan status peminjaman adalah "dipinjam"
    if ($peminjaman->status_peminjaman != 'dipinjam') {
        return redirect()->route('peminjaman.index')->with('error', 'Peminjaman ini tidak dalam status dipinjam.');
    }

    // Update stok barang
    foreach ($peminjaman->details as $detail) {
        $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();

        if ($ketersediaan) {
            $ketersediaan->jumlah_tersedia += $detail->jumlah_barang;
            $ketersediaan->tanggal_terakhir_update = now();
            $ketersediaan->save();
        }
    }

    // Tandai peminjaman sebagai selesai
    $peminjaman->markAsReturned(now());

    return redirect()->route('peminjaman.index')->with('success', 'Barang berhasil dikembalikan.');
}

}

// public function accPeminjaman($peminjaman_id)
//     {

//         $peminjaman = Peminjaman::with('details')->findOrFail($peminjaman_id);

//         if (Auth::user()->role_id == 1) {
//             // Pastikan statusnya masih pending
//             if ($peminjaman->status_peminjaman != 'pending') {
//                 return redirect()->route('peminjaman.index')->with('error', 'Peminjaman sudah diproses sebelumnya.');
//             }

//             // Kurangi jumlah barang di tabel ketersediaan_barang
//             foreach ($peminjaman->details as $detail) {
//                 $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();

//                 if ($ketersediaan && $ketersediaan->jumlah_tersedia >= $detail->jumlah_barang) {
//                     $ketersediaan->jumlah_tersedia -= $detail->jumlah_barang;
//                     $ketersediaan->tanggal_terakhir_update = now();
//                     $ketersediaan->save();
//                 } else {
//                     return redirect()->route('peminjaman.index')->with('error', 'Stok barang tidak mencukupi.');
//                 }
//             }
//             dd($peminjaman->id, $detail->barang_id, $detail->jumlah_barang);
//             // Update status peminjaman menjadi 'dipinjam'
//             $peminjaman->status_peminjaman = 'dipinjam';
//             $peminjaman->save();

//             // Tambahkan data ke tabel pengembalian
//             foreach ($peminjaman->details as $detail) {
//                 if (!$peminjaman->peminjaman_id || !$detail->barang_id || !$detail->jumlah_barang) {
//                     return redirect()->route('peminjaman.index')->with('error', 'Data peminjaman tidak valid.');
//                 }

//                 Pengembalian::create([
//                     'peminjaman_id' => $peminjaman->id,
//                     'barang_id' => $detail->barang_id,
//                     'jumlah_barang' => $detail->jumlah_barang,
//                     'tanggal_kembali' => null, // Akan diisi saat user mengembalikan
//                     'status_pengembalian' => 'belum dikembalikan',
//                 ]);
//             }


//             return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disetujui.');
//         }

//         return redirect()->route('peminjaman.index')->with('error', 'Hanya admin yang bisa menyetujui peminjaman.');
//     }

