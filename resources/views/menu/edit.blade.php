@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Menu</h1>

    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Menu</label>
            <input type="text" name="menu_name" class="form-control" value="{{ $menu->menu_name }}" required>
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="menu_link" class="form-control" value="{{ $menu->menu_link }}" required>
        </div>
        <div class="form-group">
            <label for="menu_icon">Ikon Menu</label>
            <select name="menu_icon" class="form-control">
                <option value="">Pilih Ikon</option>
                <option value="fas fa-home" {{ $menu->menu_icon == 'fas fa-home' ? 'selected' : '' }}>🏠 Home</option>
                <option value="fas fa-user" {{ $menu->menu_icon == 'fas fa-user' ? 'selected' : '' }}>👤 User</option>
                <option value="fas fa-cog" {{ $menu->menu_icon == 'fas fa-cog' ? 'selected' : '' }}>⚙️ Settings</option>
                <option value="fas fa-envelope" {{ $menu->menu_icon == 'fas fa-envelope' ? 'selected' : '' }}>✉️ Mail</option>
                <option value="fas fa-book" {{ $menu->menu_icon == 'fas fa-book' ? 'selected' : '' }}>📚 Book</option>
                <!-- Tambahkan lebih banyak ikon sesuai kebutuhan -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
