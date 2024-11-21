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

    <!-- Form Tambah Barang -->
    <div class="card mb-4">
        <div class="card-header">Form Tambah Barang</div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Barang:</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama barang" required>
                </div>
                <div class="form-group">
                    <label for="harga_satuan">Harga Satuan:</label>
                    <input type="number" id="harga_satuan" name="harga_satuan" class="form-control" placeholder="Masukkan harga satuan" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="idsatuan">Satuan:</label>
                    <select id="idsatuan" name="idsatuan" class="form-control" required>
                        <option value="">Pilih Satuan</option>
                        @foreach ($satuan as $item)
                            <option value="{{ $item['idsatuan'] }}">{{ $item['nama_satuan'] }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
