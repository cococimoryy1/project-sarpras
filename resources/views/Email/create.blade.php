@extends('layout.main')

@section('content')
    <h1>Tambah Jenis User</h1>

    <form action="{{ url('/email/send') }}" method="POST">
        @csrf
        <!-- Input Subject -->
        <div class="form-group">
            <label for="subject">Subjek:</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
            @error('subject')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Input Email Tujuan -->
        <div class="form-group">
            <label for="to">Kirim ke:</label>
            <input type="email" name="to" class="form-control" value="{{ old('to') }}" required>
            @error('to')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Input Pesan -->
        <div class="form-group">
            <label for="message_text">Pesan:</label>
            <textarea name="message_text" class="form-control" rows="5" required>{{ old('message_text') }}</textarea>
            @error('message_text')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Tombol Kirim -->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Kirim Email</button>
        </div>
    </form>
@endsection
