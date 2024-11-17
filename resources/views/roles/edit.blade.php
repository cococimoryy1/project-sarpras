@extends('layouts.main')

@section('content')
<div class="container">
    <h1>{{ isset($role) ? 'Edit Role' : 'Tambah Role' }}</h1>
    <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
        @csrf
        @if (isset($role))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Nama Role</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name ?? old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control">{{ $role->description ?? old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($role) ? 'Perbarui' : 'Simpan' }}</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
