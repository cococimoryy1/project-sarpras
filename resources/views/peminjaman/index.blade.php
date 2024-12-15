@extends('layouts.main')

@section('content')
<div class="container">
    <!-- Tampilkan untuk User -->
    @if(Auth::user()->role_id == 2)
    <h2 class="mb-4">Ajukan Peminjaman</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Daftar Barang yang Tersedia untuk Dipinjam -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                    <tr>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>{{ $barang->ketersediaan ? $barang->ketersediaan->jumlah_tersedia : 'Tidak tersedia' }}</td>
                        <td>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#pinjamModal{{ $barang->barang_id }}">Pinjam</a>

                            <!-- Modal Form Peminjaman -->
                            <div class="modal fade" id="pinjamModal{{ $barang->barang_id }}" tabindex="-1" role="dialog" aria-labelledby="pinjamModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('peminjaman.store') }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="pinjamModalLabel">Form Peminjaman</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="barang_id" value="{{ $barang->barang_id }}">
                                                <div class="form-group">
                                                    <label for="jumlah_barang">Jumlah Barang</label>
                                                    <input type="number" name="jumlah_barang" class="form-control" min="1" max="{{ $barang->ketersediaan ? $barang->ketersediaan->jumlah_tersedia : 0 }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                                                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_kembali">Tanggal Pengembalian</label>
                                                    <input type="date" name="tanggal_kembali" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Daftar Peminjaman User -->
    <h3 class="mt-5">Daftar Barang yang Dipinjam</h3>

    @if($userPeminjamanList->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userPeminjamanList as $peminjaman)
                    @foreach($peminjaman->details as $detail)
                        <tr>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $peminjaman->status_peminjaman }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada barang yang dipinjam atau belum disetujui.</p>
    @endif
@endif
    <!-- Tampilkan untuk Admin -->
    @if(Auth::user()->role_id == 1)
        <h2 class="mt-5">Daftar Peminjaman Menunggu Persetujuan</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Pemohon</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamanList as $peminjaman)
                    @foreach($peminjaman->details as $detail)
                    <tr>
                        <td>{{ $peminjaman->user->username }}</td>
                        <td>{{ $detail->barang->nama_barang }}</td>
                        <td>{{ $detail->jumlah_barang }}</td>
                        <td>{{ $peminjaman->status_peminjaman }}</td>
                        <td>
                            <form action="{{ route('peminjaman.approve', $peminjaman->peminjaman_id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Setujui</button>
                            </form>
                            <form action="{{ route('peminjaman.reject', $peminjaman->peminjaman_id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
