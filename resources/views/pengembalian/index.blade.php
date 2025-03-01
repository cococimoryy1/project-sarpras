@extends('layouts.main')

@section('content')
<div class="container">
    <!-- Jika Role adalah Admin -->
    @if(Auth::user()->role_id == 1)
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
                            <td>{{ $pengembalian->peminjaman->user->username }}</td> <!-- Menampilkan nama user -->
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $pengembalian->tanggal_kembali ?? 'Belum Dikembalikan' }}</td>
                            <td>
                                @if($pengembalian->status_pengembalian == 'belum dikembalikan')
                                    <span class="text-warning">Belum Dikembalikan</span>
                                @else
                                    <span class="text-success">Sudah Dikembalikan</span>
                                @endif
                            </td>
                            <td>
                                <!-- Tombol Detail -->
                                <a href="{{ route('pengembalian.detail', $pengembalian->pengembalian_id) }}" class="btn btn-info">Detail</a>

                                @if($pengembalian->status_pengembalian == 'belum dikembalikan')
                                    <form action="{{ route('pengembalian.acc', $pengembalian->pengembalian_id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled>Sudah Disetujui</button>
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

    <h3>Daftar Pengembalian yang Sudah Dikembalikan</h3>
    @if($pengembalianSelesaiList->isNotEmpty())
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
                @foreach($pengembalianSelesaiList as $pengembalian)
                    @foreach($pengembalian->peminjaman->details as $detail)
                        <tr>
                            <td>{{ $pengembalian->peminjaman->user->username }}</td> <!-- Nama User -->
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $pengembalian->tanggal_kembali ?? 'Belum Dikembalikan' }}</td>
                            <td>
                                <span class="text-success">Sudah Dikembalikan</span>
                            </td>
                            <td>
                                <!-- Tombol Detail -->
                                <a href="{{ route('pengembalian.detail', $pengembalian->pengembalian_id) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada pengembalian yang sudah dikembalikan.</p>
    @endif

    <!-- Menutup blok if Admin -->
    @endif

    <!-- Jika Role adalah User -->
    @if(Auth::user()->role_id == 2)
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
                                    <span class="text-success">Dalam Tenggat Waktu</span>
                                @endif
                            </td>
                            <td>
                                @if($denda > 0)
                                    Rp{{ number_format($denda, 0, ',', '.') }}
                                @else
                                    Tidak Ada
                                @endif
                            </td>
                            <td>
                                <!-- Tombol Detail -->
                                <a href="{{ route('pengembalian.detail', $peminjaman->peminjaman_id) }}" class="btn btn-info">Detail</a>

                                <form action="{{ route('pengembalian.store', $peminjaman->peminjaman_id) }}" method="POST" style="display:inline-block;">
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

    <h3>Daftar Barang yang Sudah Dikembalikan</h3>
    @if($peminjamanSelesaiList->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamanSelesaiList as $peminjaman)
                    @foreach($peminjaman->details as $detail)
                        <tr>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali }}</td>
                            <td>
                                <span class="text-success">Sudah Dikembalikan</span>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <p>Anda belum mengembalikan barang apapun.</p>
    @endif

    <!-- Menutup blok if User -->
    @endif
</div>
@endsection












