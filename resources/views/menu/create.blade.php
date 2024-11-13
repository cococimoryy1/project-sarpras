@extends('layout.main')

@section('content')
<div class="container">
    <h1>Tambah Menu</h1>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Menu</label>
            <input type="text" name="menu_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="menu_link" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="menuLevels_id">Menu Level:</label>
            <select name="menuLevels_id" class="form-select" id="menuLevels_id" required>
                <option value="">Pilih Menu Level</option>
                <!-- Tambahkan pilihan sesuai dengan level menu yang ada -->
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
            </select>
        </div>
        <div class="form-group">
            <label for="menu_icon">Ikon Menu</label>
            <select name="menu_icon" class="form-control">
                <option value="">Pilih Ikon</option>
                <option value="fas fa-home">🏠 Home</option>
                <option value="fas fa-user">👤 User</option>
                <option value="fas fa-cog">⚙️ Settings</option>
                <option value="fas fa-envelope">✉️ Mail</option>
                <option value="fas fa-book">📚 Book</option>
                <!-- Tambahkan lebih banyak ikon sesuai kebutuhan -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
