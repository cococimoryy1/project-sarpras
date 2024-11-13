@extends('layout.main')
@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h3 class="mb-3">Edit Profile</h3>
            <form action="{{ route('profile.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="{{ $data->email }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $data->username }}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Fullname</label>
                    <input type="text" name="nama_user" class="form-control" value="{{ $data->nama_user }}">
                </div>
                {{--  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nomer WA</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $data->no_hp }}">
                </div>  --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
