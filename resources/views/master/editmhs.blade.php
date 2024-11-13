@extends('layout.main')

@section('title', 'Edit Mahasiswa')

@section('page-title', 'Edit Mahasiswa')

@section('page-breadcrumb')
    <li class="breadcrumb-item">Mahasiswa</li>
    <li class="breadcrumb-item">Edit Mahasiswa</li>
@endsection

@section('page-css')
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection

@section('page-content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Mahasiswa</h3>
        </div>
        <div class="card-body">
            <form action="/updatemhs/{{ $mahasiswa->id_mahasiswa }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="nm" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                    <div class="col-sm-10">
                        <input name="nama" type="text" class="form-control" id="nm" value="{{ $mahasiswa->nama }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input name="nim" type="text" class="form-control" id="nim" value="{{ $mahasiswa->nim }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-right">Update</button>
            </form>
        </div>
    </div>
@endsection

@section('page-js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(window).on("load", function() {
            @if (session()->has('notif'))
                toastr.success('{{ session('notif') }}');
            @endif
        });
    </script>
@endsection
