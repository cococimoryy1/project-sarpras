@extends('layouts.main')

@section('content')
<div class="container">
    {{-- Admin: Menampilkan daftar pengembalian --}}
    @if(Auth::user()->role_id == 1)
        <h3>Daftar Pengembalian</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($pengembalianList->isNotEmpty())
            <table class="table table-bordered">
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
                                <td>{{ $pengembalian->peminjaman->user->username }}</td>
                                <td>{{ $detail->barang->nama_barang }}</td>
                                <td>{{ $detail->jumlah_barang }}</td>
                                <td>{{ $pengembalian->tanggal_kembali }}</td>
                                <td>
                                    @if($pengembalian->status_pengembalian == 'belum dikembalikan')
                                        <span class="badge badge-warning">Belum Dikembalikan</span>
                                    @else
                                        <span class="badge badge-success">Sudah Dikembalikan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pengembalian->status_pengembalian == 'belum dikembalikan')
                                        <form action="{{ route('pengembalian.acc', $pengembalian->pengembalian_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Diproses</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada pengembalian yang tersedia.</p>
        @endif
    @endif

    {{-- User: Menampilkan daftar peminjaman --}}
    @if(Auth::user()->role_id == 2)
        <h3>Daftar Peminjaman Anda</h3>

        @if($peminjamanList->isNotEmpty())
            <table class="table table-bordered">
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
                                        <span class="badge badge-info">Dipinjam</span>
                                    @elseif($peminjaman->status_peminjaman == 'menunggu pengembalian')
                                        <span class="badge badge-warning">Menunggu Pengembalian</span>
                                    @else
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($peminjaman->status_peminjaman == 'dipinjam')
                                        <form action="{{ route('pengembalian.store', $peminjaman->peminjaman_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Ajukan Pengembalian</button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Tidak Ada Aksi</button>
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
