<!-- resources/views/menus/index.blade.php -->

@extends('layouts.main')


@section('content')
    <div class="container">
        <h1>Menu</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Deskripsi</th>
                    <th>Link</th> <!-- Menambahkan kolom Link -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- resources/views/menus/index.blade.php -->

                @foreach($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ $menu->deskripsi_menu }}</td>
                        <td><a href="{{ $menu->link }}" target="_blank">{{ $menu->link }}</a></td>
                        <td>
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('akses.create', $menu->id) }}" class="btn btn-info">Atur Akses</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
@endsection
