@extends('layout.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Master Kelas</h3>
        </div>
        <!--/.card header-->
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (Auth::user()->id_jenis_user == 'admin')
                <form action="{{ route('simpan_master_kelas') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input type="text" name="kode_kelas" id="kode_kelas" class="form-control"
                            placeholder="Kode Kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control"
                            placeholder="Nama Kelas" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

                <hr>
            @endif
            <h4>Daftar Kelas</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $kls)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kls->kode_kelas }}</td>
                            <td>{{ $kls->nama_kelas }}</td>
                            <td>
                                <!-- Tambahkan aksi seperti edit atau delete jika diperlukan -->
                                <form action="{{ route('delete_master_kelas', $kls->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--/.card-body-->
    </div>
@endsection

@section('page-js')
    <script>
        // Tambahkan JavaScript tambahan di sini jika diperlukan
    </script>
@endsection
