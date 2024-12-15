@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Daftar Menu</h1>
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
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ $menu->deskripsi_menu }}</td>
                        <td>{{ $menu->link }}</td>
                        <td>
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @if($menu->children)
                        @foreach($menu->children as $child)
                            <tr>
                                <td></td>
                                <td>-- {{ $child->nama_menu }}</td>
                                <td>{{ $child->deskripsi_menu }}</td>
                                <td>{{ $child->link }}</td>
                                <td>
                                    <a href="{{ route('menus.edit', $child->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('menus.destroy', $child->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
