@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Barang</h1>
    <a href="{{ route('barangs.create') }}" class="btn btn-primary">Tambah Barang</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Jumlah Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
            <tr>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->deskripsi_barang ?? 'Tidak ada deskripsi' }}</td> <!-- Menambahkan deskripsi barang -->

                <!-- Check if kategori exists and display its name -->
                <td>{{ $barang->kategori ? $barang->kategori->nama_kategori : 'Kategori tidak ada' }}</td>

                <td>{{ $barang->jumlah_total }}</td>
                <td>
                    <a href="{{ route('barangs.edit', $barang->barang_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barangs.destroy', $barang->barang_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
