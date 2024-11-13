@extends('layout.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Jadwal Kuliah</h3>
        </div>
        <div class="card-body">
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
                <div class="form-group">
                    <label for="ruang">Ruang</label>
                    <input type="text" name="ruang" id="ruang" class="form-control" value="{{ $jadwal_kuliah->ruang }}" required>
                </div>
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <input type="text" name="hari" id="hari" class="form-control" value="{{ $jadwal_kuliah->hari }}" required>
                </div>
                <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="text" name="jam" id="jam" class="form-control" value="{{ $jadwal_kuliah->jam }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
