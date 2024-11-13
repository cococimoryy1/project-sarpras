@extends('layout.main')

@section('content')
    @if (Auth::user()->id_jenis_user == '1')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Dosen</h3>
            </div>
            <!--/.card header-->
            <div class="card-body">
                <form action="{{ route('simpan_master_dosen') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_dosen">Kode Dosen</label>
                        <input type="text" name="kode_dosen" id="kode_dosen" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_dosen">Nama Dosen</label>
                        <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

                <hr>
    @endif
    <!-- Tabel untuk menampilkan data dosen -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode Dosen</th>
                    <th>Nama Dosen</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop untuk menampilkan data dosen --}}
                @foreach ($dosens as $dosens)
                    <tr>
                        <td>{{ $dosens->kode_dosen }}</td>
                        <td>{{ $dosens->nama_dosen }}</td>
                        <td>{{ $dosens->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <!--/.card-body-->
    </div>
@endsection
