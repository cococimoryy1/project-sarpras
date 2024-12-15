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
    public function index()
    {
        // Ambil data barang dengan relasi kategori dan ketersediaan
        $barangs = Barang::with('kategori', 'ketersediaan')->get();

        // Ambil daftar peminjaman jika user adalah admin
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

        // Hitung total hari berdasarkan tanggal pinjam dan kembali
        $tanggal_pinjam = Carbon::parse($request->tanggal_pinjam);
        $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
        $total_hari = $tanggal_pinjam->diffInDays($tanggal_kembali);

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

        // Update status peminjaman menjadi 'dipinjam'
        $peminjaman->update(['status_peminjaman' => 'dipinjam']);

        // Buat entri awal di tabel pengembalian
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


    public function tolakPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if (Auth::user()->role_id == 1) {
            if ($peminjaman->status_peminjaman != 'pending') {
                return redirect()->route('peminjaman.index')->with('error', 'Peminjaman ini sudah diproses.');
            }

            // Update status peminjaman menjadi 'dibatalkan'
            $peminjaman->update(['status_peminjaman' => 'dibatalkan']);

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
                $ketersediaan->increment('jumlah_tersedia', $detail->jumlah_barang);
            }
        }

        // Tandai peminjaman sebagai selesai
        $peminjaman->update([
            'status_peminjaman' => 'selesai',
            'tanggal_kembali_sebenarnya' => now(),
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Barang berhasil dikembalikan.');
    }
}
