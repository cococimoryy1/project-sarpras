@extends('layout.main')

@section('content')
    <h1>Tambah Jenis User</h1>

    <form action="{{ route('jenis_user.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="ID_JENIS_USER">ID Jenis User:</label>
            <input type="text" id="ID_JENIS_USER" name="ID_JENIS_USER" class="form-control" value="{{ old('ID_JENIS_USER') }}" required>
            @error('ID_JENIS_USER')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="JENIS_USER">Jenis User:</label>
            <input type="text" id="JENIS_USER" name="JENIS_USER" class="form-control" value="{{ old('JENIS_USER') }}" required>
            @error('JENIS_USER')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="CREATE_BY">Created By:</label>
            <input type="text" id="CREATE_BY" name="CREATE_BY" class="form-control" value="{{ old('CREATE_BY') }}" required>
            @error('CREATE_BY')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
