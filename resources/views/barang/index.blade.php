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

    <!-- Form Input dan Tabel Data Barang -->
    <div class="card mb-4">
        <div class="card-header">Tambah Barang</div>
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
                    <input type="text" id="status" name="status" class="form-control" placeholder="Masukkan status (1 atau 0)" maxlength="1">
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

    <!-- Tabel Daftar Barang -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Status</th>
                <th>Satuan</th>
                <th>Aksi</th> <!-- Tambahkan kolom aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $item)
                <tr>
                    <td>{{ $item['idbarang'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['harga_satuan'] }}</td>
                    <td>{{ $item['status'] }}</td>
                    <td>{{ $item['nama_satuan'] }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="{{ route('barang.edit', $item['idbarang']) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Tombol Delete -->
                        <form action="{{ route('barang.destroy', $item['idbarang']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
