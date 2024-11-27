@extends('layouts.main')

@section('content')
<div class="container">
    @if(Auth::user()->role_id == 2)  <!-- User -->
        <h3>Peminjaman Barang Anda</h3>
        @if($peminjamanList->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamanList as $peminjaman)
                        @foreach($peminjaman->details as $detail)
                            <tr>
                                <td>{{ $detail->barang->nama_barang }}</td>
                                <td>
                                    @if($detail->status_terlambat)
                                        <span class="text-danger">Terlambat!</span>
                                    @else
                                        <span class="text-success">Tepat waktu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($detail->status_terlambat && $peminjaman->status_peminjaman == 'dipinjam' && !$detail->pengembalian) <!-- Ensure it's overdue and hasn't been returned yet -->
                                        <form action="{{ route('pengembalian.store', $peminjaman->peminjaman_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Kembalikan Barang</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Anda tidak memiliki peminjaman yang aktif.</p>
        @endif
    @elseif(Auth::user()->role_id == 1) <!-- Admin -->
        <h3>Pengembalian Menunggu Persetujuan</h3>
        @if($pengembalianList->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Pemohon</th>
                        <th>Barang</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalianList as $pengembalian)
                        <tr>
                            <td>{{ $pengembalian->peminjaman->user->name }}</td>
                            <td>{{ $pengembalian->peminjaman->details->first()->barang->nama_barang }}</td>
                            <td>{{ $pengembalian->tanggal_kembali }}</td>
                            <td>{{ $pengembalian->status_pengembalian }}</td>
                            <td>
                                <form action="{{ route('pengembalian.approve', $pengembalian->pengembalian_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Setujui Pengembalian</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada pengembalian yang menunggu persetujuan.</p>
        @endif
    @endif
</div>
@endsection
