@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Barang</h1>

    <form action="{{ route('barangs.update', $barang->barang_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
            <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang">{{ $barang->deskripsi_barang }}</textarea>
        </div>

        <div class="mb-3">
            <label for="kategori_barang" class="form-label">Kategori Barang</label>
            <select class="form-control" id="kategori_barang" name="kategori_barang_id" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoriBarangs as $kategori)
                    <option value="{{ $kategori->kategori_id }}"
                        @if($barang->kategori_barang_id == $kategori->kategori_id) selected @endif>
                        {{ $kategori->kategori_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah_total" class="form-label">Jumlah Total</label>
            <input type="number" class="form-control" id="jumlah_total" name="jumlah_total" value="{{ $barang->jumlah_total }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
