<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\KetersediaanBarang;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    
    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        $kategoriBarangs = Category::all(); // Mengambil semua data kategori
        return view('barang.create', compact('kategoriBarangs'));
    }

    // Menyimpan barang baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'deskripsi_barang' => 'nullable|string',
            'kategori_barang_id' => 'required|exists:kategori,id_kategori',
            'jumlah_total' => 'required|integer|min:1',
        ]);

        // Menyimpan data barang ke database
        $barang = Barang::create([
            'nama_barang' => $validated['nama_barang'],
            'deskripsi_barang' => $validated['deskripsi_barang'],
            'kategori_barang_id' => $validated['kategori_barang_id'],
            'jumlah_total' => $validated['jumlah_total'],
            'jumlah_tersedia' => $validated['jumlah_total'], // Menyimpan jumlah_tersedia pada tabel barang
        ]);

        // Menambahkan ketersediaan untuk barang yang baru ditambahkan
        // Cek apakah sudah ada entri ketersediaan untuk barang ini
        $ketersediaan = KetersediaanBarang::where('barang_id', $barang->barang_id)->first();

        if ($ketersediaan) {
            // Jika entri ketersediaan sudah ada, perbarui jumlah_tersedia
            $ketersediaan->jumlah_tersedia += $validated['jumlah_total']; // Menambah jumlah tersedia
            $ketersediaan->tanggal_terakhir_update = now(); // Perbarui tanggal terakhir
            $ketersediaan->save();
        } else {
            // Jika belum ada entri ketersediaan, buat entri baru
            KetersediaanBarang::create([
                'barang_id' => $barang->barang_id,
                'status_tersedia' => 'tersedia',  // Status awal barang adalah tersedia
                'jumlah_tersedia' => $validated['jumlah_total'], // Jumlah tersedia sesuai dengan jumlah total barang
                'tanggal_terakhir_update' => now(),
            ]);
        }

        // Redirect ke halaman daftar barang setelah berhasil
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
    }





    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::with('ketersediaan')->get();

        $barangs = Barang::with('kategori')->get(); // Memuat data barang beserta kategori terkait
        return view('barang.index', compact('barangs'));
    }

    // Menampilkan form untuk mengedit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoriBarangs = Category::all(); // Mengambil semua kategori barang
        return view('barang.edit', compact('barang', 'kategoriBarangs'));
    }

    // Memperbarui data barang yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'deskripsi_barang' => 'nullable|string',
            'kategori_barang_id' => 'required|exists:kategori,id_kategori', // Perbaiki referensi ke tabel 'kategori'
            'jumlah_total' => 'required|integer|min:1',
        ]);

        // Mencari barang yang akan diupdate
        $barang = Barang::findOrFail($id);

        // Memperbarui data barang
        $barang->update([
            'nama_barang' => $validated['nama_barang'],
            'deskripsi_barang' => $validated['deskripsi_barang'],
            'kategori_barang_id' => $validated['kategori_barang_id'], // Gunakan kategori_barang_id
            'jumlah_total' => $validated['jumlah_total'],
        ]);

        // Redirect setelah berhasil mengupdate barang
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete(); // Menghapus barang

        // Redirect setelah berhasil menghapus barang
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }
}

