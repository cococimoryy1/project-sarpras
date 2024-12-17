@extends('layouts.main')

@section('content')
<div class="container">
    <h3>Detail Peminjaman</h3>
    <p><strong>Nama Peminjam:</strong> {{ $peminjaman->user->username }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_kembali }}</p>
    <p><strong>Status:</strong> {{ $peminjaman->status_peminjaman }}</p>

    <h4>Daftar Barang</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman->details as $detail)
                <tr>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
