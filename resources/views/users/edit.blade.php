@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit user</h1>

    <f  orm action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        {{--  @method('PUT') <!-- Pastikan metode PUT untuk pembaruan -->  --}}
        <div class="form-group">
            <label for="name">ID User</label>
            <input type="text" name="id_user" class="form-control" value="{{ $user->id}}" required readonly>
        </div>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->nama_user }}" required>
        </div>
        {{--  <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
        </div>  --}}
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" name="email" class="form-control" value="{{ $user->email }}" required readonly>
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
