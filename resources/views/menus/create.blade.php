<!-- resources/views/menus/create.blade.php -->

@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Tambah Menu</h1>
        <form action="{{ route('menus.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input type="text" id="nama_menu" name="nama_menu" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_menu">Deskripsi Menu</label>
                <textarea id="deskripsi_menu" name="deskripsi_menu" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection