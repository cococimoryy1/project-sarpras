<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Satuan;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barang = Barang::with('satuan')->get();
        $satuan = Satuan::all();

        return view('barang.index', compact('barang', 'satuan'));
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric|min:0',
            'status' => 'nullable|in:0,1',
            'idsatuan' => 'required|exists:satuan,idsatuan',
        ]);

        try {
            Barang::create([
                'nama' => $request->nama,
                'harga_satuan' => $request->harga_satuan,
                'status' => $request->status,
                'idsatuan' => $request->idsatuan,
            ]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('barang.index')->with('error', 'Terjadi kesalahan saat menambahkan barang!');
        }
    }

    // Menampilkan form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $satuan = Satuan::all();

        return view('barang.edit', compact('barang', 'satuan'));
    }

    // Memperbarui data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric|min:0',
            'status' => 'nullable|in:0,1',
            'idsatuan' => 'required|exists:satuan,idsatuan',
        ]);

        try {
            $barang = Barang::findOrFail($id);
            $barang->update([
                'nama' => $request->nama,
                'harga_satuan' => $request->harga_satuan,
                'status' => $request->status,
                'idsatuan' => $request->idsatuan,
            ]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('barang.index')->with('error', 'Terjadi kesalahan saat memperbarui barang!');
        }
    }

    // Menghapus barang
    public function destroy($id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $barang->delete();

            return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('barang.index')->with('error', 'Terjadi kesalahan saat menghapus barang!');
        }
    }
}
