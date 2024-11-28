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
@endif

</div>
@endsection
