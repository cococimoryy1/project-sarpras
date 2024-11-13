@extends('layout.main')

@section('content')
    <h1>Detail Jenis User</h1>

    <div>
        <strong>ID Jenis User:</strong> {{ $jenisUser->ID_JENIS_USER }}<br>
        <strong>Jenis User:</strong> {{ $jenisUser->JENIS_USER }}<br>
        <strong>Dibuat Oleh:</strong> {{ $jenisUser->CREATE_BY }}<br>
        <strong>Terakhir Diubah Oleh:</strong> {{ $jenisUser->UPDATE_BY }}<br>
        <strong>Delete Mark:</strong> {{ $jenisUser->DELETE_MARK ? 'Deleted' : 'Active' }}<br>
    </div>
@endsection
