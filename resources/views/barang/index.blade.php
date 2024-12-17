@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1>Kelola Barang</h1>

    <!-- Menampilkan pesan sukses atau error -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Tombol Tambah Barang -->
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    <!-- Tabel Daftar Barang -->
    <div class="card">
        <div class="card-header">Daftar Barang</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Total</th>
                        <th>Jumlah Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td>{{ $barang->barang_id }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->jumlah_total }}</td>
                            <td>
                                @if($barang->ketersediaan) 
                                    {{ $barang->ketersediaan->jumlah_tersedia }}
                                @else
                                    <span class="text-danger">Data Tidak Tersedia</span>
                                @endif
                            </td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('barang.edit', $barang->barang_id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('barang.destroy', $barang->barang_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
