@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Detail Peminjaman</h2>

    <!-- Informasi Peminjaman -->
    <div class="card mb-4">
        <div class="card-header">Informasi Peminjaman</div>
        <div class="card-body">
            <p><strong>Nama Pemohon:</strong> {{ $peminjaman->user->username }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
            <p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_kembali }}</p>
            <p><strong>Status Peminjaman:</strong> {{ ucfirst($peminjaman->status_peminjaman) }}</p>
        </div>
    </div>

    <!-- Detail Barang -->
    <div class="card">
        <div class="card-header">Barang yang Dipinjam</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
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
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary mt-4">Kembali</a>
</div>
@endsection
