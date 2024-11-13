@extends('layout.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Users Activity</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->nama_user }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->deskripsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
@endsection
