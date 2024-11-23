@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1>Tambah Barang</h1>

    <!-- Menampilkan pesan sukses atau error -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form Input Barang -->
    <div class="card mb-4">
        <div class="card-header">Tambah Barang</div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_total">Jumlah Total:</label>
                    <input type="number" id="jumlah_total" name="jumlah_total" class="form-control" placeholder="Masukkan jumlah total barang" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_tersedia">Jumlah Tersedia:</label>
                    <input type="number" id="jumlah_tersedia" name="jumlah_tersedia" class="form-control" placeholder="Masukkan jumlah barang yang tersedia" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
