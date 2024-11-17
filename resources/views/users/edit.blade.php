@extends('layouts.main')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->iduser) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
