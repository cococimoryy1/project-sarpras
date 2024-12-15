@extends('layouts.main')

@section('content')
<div class="container">
    {{-- Jika role_id adalah admin --}}
    @if(Auth::user()->role_id == 1)
    <h3>Daftar Pengembalian Menunggu Persetujuan</h3>
    @if(isset($pengembalianList) && $pengembalianList->isNotEmpty())
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

    {{-- Jika role_id adalah user --}}
    @if(Auth::user()->role_id == 2)
    <h3>Daftar Peminjaman Saya</h3>
    @if(isset($peminjamanList) && $peminjamanList->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamanList as $peminjaman)
                    @foreach($peminjaman->details as $detail)
                        <tr>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali }}</td>
                            <td>
                                @if($peminjaman->status_peminjaman == 'dipinjam')
                                    <span class="text-info">Dipinjam</span>
                                @elseif($peminjaman->status_peminjaman == 'menunggu pengembalian')
                                    <span class="text-warning">Menunggu Pengembalian</span>
                                @else
                                    <span class="text-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($peminjaman->status_peminjaman == 'dipinjam')
                                    <form action="{{ route('pengembalian.store', $peminjaman->peminjaman_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Ajukan Pengembalian</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled>Tidak Ada Aksi</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada peminjaman yang sedang berlangsung.</p>
    @endif
    @endif
</div>
@endsection
