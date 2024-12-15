@extends('layouts.main')

@section('content')
<div class="container">
    <h3>Daftar Barang Tersedia</h3>

    @if($barangList->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Tersedia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangList as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori ?? 'Tidak Ada Kategori' }}</td>
                        <td>{{ $barang->deskripsi_barang }}</td>
                        <td>{{ $barang->ketersediaan->jumlah_tersedia ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada barang yang tersedia.</p>
    @endif
</div>
@endsection
