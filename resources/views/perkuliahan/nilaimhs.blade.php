@extends('layout.main')

@section('content')
    @if (Auth::user()->id_jenis_user == '1')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input Nilai Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('simpan.nilai') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa"
                            placeholder="Masukkan Nama Mahasiswa">
                    </div>
                    <div class="form-group">
                        <label for="mata_kuliah">Mata Kuliah</label>
                        <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah"
                            placeholder="Masukkan Mata Kuliah">
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="number" class="form-control" id="nilai" name="nilai"
                            placeholder="Masukkan Nilai">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nilai Mahasiswa</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_mahasiswa }}</td>
                            <td>{{ $item->mata_kuliah }}</td>
                            <td>{{ $item->nilai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
