@extends('layouts.main')

@section('content')
<div class="container">
    <h3>Detail Pengembalian</h3>

    <h5>Informasi Peminjam</h5>
    <table class="table">
        <tr>
            <th>Nama Peminjam</th>
            <td>{{ $pengembalian->peminjaman->user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $pengembalian->peminjaman->user->email }}</td>
        </tr>
        <tr>
            <th>Tanggal Peminjaman</th>
            <td>{{ $pengembalian->peminjaman->tanggal_pinjam }}</td>
        </tr>
        <tr>
            <th>Tanggal Pengembalian</th>
            <td>{{ $pengembalian->tanggal_kembali ?? 'Belum Dikembalikan' }}</td>
        </tr>
        <tr>
            <th>Status Pengembalian</th>
            <td>
                @if($pengembalian->status_pengembalian == 'belum dikembalikan')
                    <span class="text-warning">Belum Dikembalikan</span>
                @else
                    <span class="text-success">Sudah Dikembalikan</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Denda</th>
            <td>Rp{{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h5>Barang yang Dipinjam</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalian->peminjaman->details as $detail)
            <tr>
                <td>{{ $detail->barang->nama_barang }}</td>
                <td>{{ $detail->jumlah_barang }}</td>
                <td>{{ $detail->barang->kategori->nama_kategori }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pengembalian.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
