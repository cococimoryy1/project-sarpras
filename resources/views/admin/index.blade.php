@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Pengajuan Peminjaman Barang</h2>
    @foreach($peminjaman as $item)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Peminjaman ID: {{ $item->peminjaman_id }} ({{ $item->user->name }})</h5>
            <p>Tanggal Pinjam: {{ $item->tanggal_pinjam }} - Tanggal Kembali: {{ $item->tanggal_kembali }}</p>
            <ul>
                @foreach($item->details as $detail)
                <li>{{ $detail->barang->nama_barang }} ({{ $detail->jumlah_barang }})</li>
                @endforeach
            </ul>
            <form action="{{ route('admin.updateStatus', ['id' => $item->peminjaman_id, 'status' => 'selesai']) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Setujui</button>
            </form>
            <form action="{{ route('admin.updateStatus', ['id' => $item->peminjaman_id, 'status' => 'dibatalkan']) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Tolak</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
