@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1>Edit Barang</h1>

    <!-- Menampilkan pesan sukses atau error -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form Input Edit Barang -->
    <div class="card mb-4">
        <div class="card-header">Edit Barang</div>
        <div class="card-body">
            <form action="{{ route('barang.update', $barang->barang_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_total">Jumlah Total:</label>
                    <input type="number" id="jumlah_total" name="jumlah_total" class="form-control" value="{{ old('jumlah_total', $barang->jumlah_total) }}" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_tersedia">Jumlah Tersedia:</label>
                    <input type="number" id="jumlah_tersedia" name="jumlah_tersedia" class="form-control" value="{{ old('jumlah_tersedia', $barang->jumlah_tersedia) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Barang</button>
            </form>
        </div>
    </div>
</div>
@endsection
