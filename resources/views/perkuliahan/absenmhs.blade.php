@extends('layout.main')


@section('content')
    @if (Auth::user()->id_jenis_user == '1')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Absensi Mahasiswa</h3>
            </div>
            <!--/.card-header-->
            <div class="card-body">
                <form action="{{ route('simpan-absen') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            placeholder="Masukkan nama mahasiswa" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" class="form-control" id="nama"
                            placeholder="Masukkan nama mahasiswa" required>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Kehadiran</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="">Pilih status kehadiran</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Tidak Hadir">Tidak Hadir</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <!--/.card-body-->
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Absensi Mahasiswa</h3>
        </div>
        <!--/.card-header-->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Tanggal</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->mahasiswa }}</td>
                                <td>{{ $item->mata_kuliah }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td class="fw-bold text-success">{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/.card-body-->
    </div>
@endsection
