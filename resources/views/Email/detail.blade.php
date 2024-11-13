@extends('layout.main')

@section('content')
<h1>{{ $message->subject }}</h1>
<p>{{ $message->message_text }}</p>
<p>Dari: {{ $message->sender }}</p>
<p>Tanggal: {{ \Carbon\Carbon::parse($message->create_date)->format('d M Y, H:i') }}</p>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('email.reply', $message->id) }}" method="POST">
    @csrf
    <textarea name="reply_message" rows="5" class="form-control" placeholder="Tulis balasan..."></textarea>
    <button type="submit" class="btn btn-success mt-2">Kirim Balasan</button>
</form>
@endsection
