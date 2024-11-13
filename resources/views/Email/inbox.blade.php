@extends('layout.main')

@section('content')
<h4 class="card-title">Inbox</h4>
<table class="table table-striped">
  <thead>
      <tr>
          <th>Pengirim</th>
          <th>Subjek</th>
          <th>Tanggal</th>
          <th>Detail</th>
      </tr>
  </thead>
  <tbody>
      @forelse($emails as $email)
          <tr>
              <td>{{ $email->sender }}</td>
              <td>{{ $email->subject}}</td>
              <td>{{ \Carbon\Carbon::parse($email->create_date)->format('d M Y, H:i') }}</td>
              <td><a href="{{ route('email.show', $email->id) }}" class="btn btn-primary btn-sm">Lihat</a></td>

          </tr>
      @empty
          <tr>
              <td colspan="4">Tidak ada email masuk.</td>
          </tr>
      @endforelse
  </tbody>
</table>
@endsection
