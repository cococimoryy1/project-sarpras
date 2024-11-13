@extends('layout.main')

@section('content')
    <!-- Main content -->
    <section class="content">
        @if (Auth::user()->id_jenis_user == '1')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Mahasiswa Baru</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('submitmhs') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="nm" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                            <div class="col-sm-10">
                                <input name="nama" type="text" class="form-control" id="nm" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input name="nim" type="text" class="form-control" id="nim" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </form>
                </div>
            </div>
        @endif

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Daftar Mahasiswa</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            @if (Auth::user()->id_jenis_user == '1') <!-- Hanya admin yang bisa melihat kolom aksi -->
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $mahasiswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                @if (Auth::user()->id_jenis_user == '1') <!-- Hanya admin yang bisa melihat tombol hapus -->
                                    <td>
                                        <form action="{{ route('deletemhs.destroy', ['nim' => $mahasiswa->nim]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content-wrapper -->
@endsection
