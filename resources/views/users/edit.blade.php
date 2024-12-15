@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit User</h1>
    <form action="{{ route('users.update', $user->iduser) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Username Field -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Password Field -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Leave blank if no change">
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

@endsection
