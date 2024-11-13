@extends('layout.main')

@section('content')
    <h1>Compose Email</h1>

    <form action="{{ route('email.send') }}" method="POST">
        @csrf
        <label for="to">To:</label>
        <input type="text" id="to" name="to" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message_text">Message:</label>
        <textarea id="message_text" name="message_text" required></textarea>

        <button type="submit">Send</button>
    </form>
@endsection
