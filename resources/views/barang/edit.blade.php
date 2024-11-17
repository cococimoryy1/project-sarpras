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

    <!-- Form Edit Barang -->
    <div class="card mb-4">
        <div class="card-header">Edit Barang</div>
        <div class="card-body">
            <form action="{{ route('barang.update', $barang['idbarang']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Barang:</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ $barang['nama'] }}" required>
                </div>
                <div class="form-group">
                    <label for="harga_satuan">Harga Satuan:</label>
                    <input type="number" id="harga_satuan" name="harga_satuan" class="form-control" value="{{ $barang['harga_satuan'] }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" class="form-control" value="{{ $barang['status'] }}" maxlength="1">
                </div>
                <div class="form-group">
                    <label for="idsatuan">Satuan:</label>
                    <select id="idsatuan" name="idsatuan" class="form-control" required>
                        <option value="">Pilih Satuan</option>
                        @foreach ($satuan as $item)
                            <option value="{{ $item['idsatuan'] }}" {{ $item['idsatuan'] == $barang['idsatuan'] ? 'selected' : '' }}>
                                {{ $item['nama_satuan'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
