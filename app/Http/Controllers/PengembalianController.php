<?php
namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\KetersediaanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman untuk user
        $user_id = Auth::id();
        $peminjamanList = Peminjaman::with(['details', 'details.barang'])
            ->where('user_id', $user_id)
            ->where('status_peminjaman', 'dipinjam')
            ->get();

        // Cek apakah peminjaman sudah melewati tanggal kembali
        foreach ($peminjamanList as $peminjaman) {
            foreach ($peminjaman->details as $detail) {
                $today = Carbon::today();
                $tanggal_kembali = Carbon::parse($peminjaman->tanggal_kembali);

                if ($today->gt($tanggal_kembali)) {
                    $detail->status_terlambat = true;
                } else {
                    $detail->status_terlambat = false;
                }
            }
        }

        // Data pengembalian untuk admin
        $pengembalianList = [];
        if (Auth::user()->role_id == 1) {
            $pengembalianList = Pengembalian::with(['peminjaman', 'peminjaman.details.barang'])
                ->where('status_pengembalian', 'belum dikembalikan')
                ->get();
        }

        // Ambil daftar barang untuk ditampilkan pada halaman peminjaman
        $barangs = Barang::with('kategori', 'ketersediaan')->get();

        // Mengirimkan semua data yang diperlukan ke view
        return view('pengembalian.index', compact('peminjamanList', 'pengembalianList', 'barangs'));
    }

    public function store(Request $request, $peminjaman_id)
    {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        // Cek jika status peminjaman adalah 'dipinjam'
        if ($peminjaman->status_peminjaman != 'dipinjam') {
            return redirect()->route('pengembalian.index')->with('error', 'Peminjaman ini tidak bisa dikembalikan.');
        }

        // Proses pembuatan pengembalian
        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman_id,
            'tanggal_kembali' => now(),
            'status_pengembalian' => 'belum dikembalikan',  // Status awal
        ]);

        // Update status peminjaman menjadi "menunggu pengembalian"
        $peminjaman->status_peminjaman = 'menunggu pengembalian';
        $peminjaman->save();

        return redirect()->route('pengembalian.index')->with('success', 'Barang telah dikembalikan dan menunggu persetujuan admin.');
    }

    // Admin menyetujui pengembalian
    public function accPengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        // Cek jika hanya admin yang bisa approve pengembalian
        if (Auth::user()->role_id != 1) {
            return redirect()->route('pengembalian.index')->with('error', 'Hanya admin yang bisa menyetujui pengembalian.');
        }

        // Update status pengembalian
        $pengembalian->status_pengembalian = 'dikembalikan';
        $pengembalian->save();

        // Update stok barang
        $peminjaman = $pengembalian->peminjaman;
        foreach ($peminjaman->details as $detail) {
            $ketersediaan = KetersediaanBarang::where('barang_id', $detail->barang_id)->first();
            if ($ketersediaan) {
                $ketersediaan->jumlah_tersedia += $detail->jumlah_barang;
                $ketersediaan->save();
            }
        }

        // Update status peminjaman menjadi 'selesai'
        $peminjaman->status_peminjaman = 'selesai';
        $peminjaman->save();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil disetujui.');
    }
}
