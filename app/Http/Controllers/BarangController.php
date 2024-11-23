<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    // Menampilkan form untuk tambah barang
    public function create()
    {
        return view('barang.create');
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'jumlah_total' => 'required|integer|min:1',
            'jumlah_tersedia' => 'required|integer|min:0',
        ]);

        // Menyimpan barang baru
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah_total' => $request->jumlah_total,
            'jumlah_tersedia' => $request->jumlah_tersedia,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Menampilkan form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    // Update data barang
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'sometimes|string|max:100',
            'jumlah_total' => 'sometimes|integer|min:1',
            'jumlah_tersedia' => 'sometimes|integer|min:0',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    // Menghapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
