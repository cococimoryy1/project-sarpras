@extends('layout.main')

@section('content')
    <h4>Edit Jenis User</h4>

    <!-- Form Edit Jenis User -->
    <form action="{{ route('jenis_user.update', $jenis_user->id_jenis_user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="jenis_user">Jenis User</label>
            <input type="text" name="jenis_user" class="form-control" value="{{ $jenis_user->jenis_user }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jenis_user.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
