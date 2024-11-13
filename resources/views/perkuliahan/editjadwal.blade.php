@extends('layout.main')

@section('content')
<form action="{{ route('update_jadwal', $jadwal_kuliah->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="mata_kuliah">Mata Kuliah</label>
        <input type="text" name="mata_kuliah" id="mata_kuliah" class="form-control" value="{{ $jadwal_kuliah->mata_kuliah }}" required>
    </div>

    <div class="form-group">
        <label for="dosen_pengampu">Dosen Pengampu</label>
        <input type="text" name="dosen_pengampu" id="dosen_pengampu" class="form-control" value="{{ $jadwal_kuliah->dosen_pengampu }}" required>
    </div>
</form>

@endsection

