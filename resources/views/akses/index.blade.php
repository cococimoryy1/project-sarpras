@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Kelola Akses Menu</h1>

    {{-- Form tambah akses --}}
    <form action="{{ route('akses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="role_id" class="form-label">Pilih Role:</label>
            <select name="role_id" id="role_id" class="form-select">
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option> <!-- Gantilah nama kolom dengan id dan name yang benar -->
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="menu_id" class="form-label">Pilih Menu:</label>
            <select name="menu_id" id="menu_id" class="form-select">
                @foreach ($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option> <!-- Gantilah nama kolom dengan id dan nama yang benar -->
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="hak_akses" class="form-label">Hak Akses:</label>
            <select name="hak_akses" id="hak_akses" class="form-select">
                <option value="lihat">Lihat</option>
                <option value="tambah">Tambah</option>
                <option value="ubah">Ubah</option>
                <option value="hapus">Hapus</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    {{-- Daftar akses --}}
    <h2 class="mt-5 mb-3">Daftar Akses</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Role</th>
                <th>Menu</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($akses as $data)
            <tr>
                <td>{{ $data->role->name }}</td>
                <td>{{ $data->menu->nama_menu }}</td>
                <td>{{ $data->hak_akses }}</td>
                <td>
                    <form action="{{ route('akses.destroy', $data->akses_id) }}" method="POST">
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
@endsection
