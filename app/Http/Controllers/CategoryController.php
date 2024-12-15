<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $kategori = Category::all();

        return view('menu.kategori', compact('kategori'));
    }

    public function add_kategori(Request $req){
        $kategori = new Category;

        $kategori->nama_kategori = $req->post('nama_kategori');

        $kategori->save();
        return redirect('/kategori');
       }
}

