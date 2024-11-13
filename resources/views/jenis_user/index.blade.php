@extends('layout.main')

@section('content')
    <h4>Daftar Jenis User</h4>

    <!-- Tampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form Tambah Jenis User -->
    <form action="{{ route('jenis_user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="jenis_user">Jenis User</label>
            <input type="text" name="jenis_user" class="form-control" placeholder="Masukkan jenis user" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <hr>

    <!-- Tabel Jenis User -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis User</th>
                <th>Dibuat Oleh</th>
                <th>Dibuat Pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenis_users as $jenis_user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jenis_user->jenis_user }}</td>
                    <td>{{ $jenis_user->create_by }}</td>
                    <td>{{ $jenis_user->create_date }}</td>
                    <td>
                        <a href="{{ route('jenis_user.edit', $jenis_user->id_jenis_user) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jenis_user.destroy', $jenis_user->id_jenis_user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
