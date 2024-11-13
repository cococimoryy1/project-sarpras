<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Category;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        $kategori = Category::all();
        return view('buku', compact('buku', 'kategori'));
    }

    public function add_buku(Request $req){
        $buku = new Buku;

        $buku->kode = $req->post('kode');
        $buku->judul = $req->post('judul');
        $buku->pengarang= $req->post('pengarang');
        $buku->id_kategori= $req->post('id_kategori');

        $buku->save();
        return redirect('/buku');
       }
}

