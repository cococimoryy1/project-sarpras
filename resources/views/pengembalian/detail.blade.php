@extends('layouts.main')

@section('content')
<div class="container">
    <h3>Detail Pengembalian</h3>
    <p><strong>User:</strong> {{ $pengembalian->peminjaman->user->username }}</p>
    <p><strong>Status Pengembalian:</strong> {{ $pengembalian->status_pengembalian }}</p>
    <p><strong>Tanggal Pengembalian:</strong> {{ $pengembalian->tanggal_kembali }}</p>
    <p><strong>Denda:</strong> {{ $pengembalian->denda }}</p>

    <h4>Daftar Barang</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalian->peminjaman->details as $detail)
                <tr>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
