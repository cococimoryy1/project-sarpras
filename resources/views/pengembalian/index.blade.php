@extends('layouts.main')

@section('content')
<div class="container">
    @if(Auth::user()->role_id == 1) <!-- Admin -->
    <h3>Daftar Pengembalian Menunggu Persetujuan</h3>
    @if($pengembalianList->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengembalianList as $pengembalian)
                    @foreach($pengembalian->peminjaman->details as $detail)
                        <tr>
                            <td>{{ $pengembalian->peminjaman->user->name }}</td>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $pengembalian->tanggal_kembali }}</td>
                            <td>
                                @if($pengembalian->status_pengembalian == 'belum dikembalikan')
                                    <span class="text-warning">Belum Dikembalikan</span>
                                @else
                                    <span class="text-success">Dikembalikan</span>
                                @endif
                            </td>
                            <td>
                                @if($pengembalian->status_pengembalian == 'belum dikembalikan')
                                    <form action="{{ route('pengembalian.acc', $pengembalian->pengembalian_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled>Sudah Dikembalikan</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada pengembalian yang menunggu persetujuan.</p>
    @endif

    @elseif(Auth::user()->role_id == 2) <!-- User -->
    <h3>Barang yang Anda Pinjam</h3>
    @if($peminjamanList->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamanList as $peminjaman)
                @foreach($peminjaman->details as $detail)
                    @php
                        $hariTerlambat = now()->diffInDays($peminjaman->tanggal_kembali, false);
                        $denda = $hariTerlambat > 2 ? ($hariTerlambat - 2) * 10000 : 0;
                    @endphp
                    <tr>
                        <td>{{ $detail->barang->nama_barang }}</td>
                        <td>{{ $detail->jumlah_barang }}</td>
                        <td>{{ $peminjaman->tanggal_pinjam }}</td>
                        <td>{{ $peminjaman->tanggal_kembali }}</td>
                        <td>
                            @if($hariTerlambat > 0)
                                <span class="text-danger">Terlambat {{ $hariTerlambat }} hari</span>
                            @else
                                <span class="text-success">Dalam tenggat waktu</span>
                            @endif
                        </td>
                        <td>
                            @if($denda > 0)
                                Rp{{ number_format($denda, 0, ',', '.') }}
                            @else
                                Tidak ada
                            @endif
                        </td>
                        <td>
                            <!-- Tombol Kembalikan -->
                            <form action="{{ route('pengembalian.store', $peminjaman->peminjaman_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Ajukan Pengembalian</button>
                            </form>


                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@else
    <p>Anda tidak memiliki barang yang sedang dipinjam.</p>
@endif

    @endif
</div>
@endsection
