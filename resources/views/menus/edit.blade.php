<!-- resources/views/menus/edit.blade.php -->

@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Menu</h1>
        <form action="{{ route('menus.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input type="text" id="nama_menu" name="nama_menu" class="form-control" value="{{ $menu->nama_menu }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_menu">Deskripsi Menu</label>
                <textarea id="deskripsi_menu" name="deskripsi_menu" class="form-control">{{ $menu->deskripsi_menu }}</textarea>
            </div>
            <div class="form-group">
                <label for="link">Link Menu</label>
                <input type="text" id="link" name="link" class="form-control" value="{{ $menu->link }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>

    </div>
@endsection
