<!-- resources/views/akses/create.blade.php -->

@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Atur Akses Menu - {{ $menu->nama_menu }}</h1>

        <form action="{{ route('akses.store', $menu->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="role_id">Pilih Role</label>
                <select name="role_id" id="role_id" class="form-control">
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hak_akses">Pilih Hak Akses</label>
                <select name="hak_akses" id="hak_akses" class="form-control">
                    <option value="lihat">Lihat</option>
                    <option value="tambah">Tambah</option>
                    <option value="ubah">Ubah</option>
                    <option value="hapus">Hapus</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Akses</button>
        </form>
    </div>
@endsection
