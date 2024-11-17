@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Daftar User</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tambah User Button -->
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

        <!-- Table -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role ? $user->role->name : 'No Role' }}</td> <!-- Menampilkan nama role -->
                        <td>
                            <a href="{{ route('users.edit', $user->iduser) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('users.destroy', $user->iduser) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST') <!-- Ganti dengan POST untuk mengatasi keterbatasan HTML form -->
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
