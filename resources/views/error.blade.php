@extends('layout.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Errors Log</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Tanggal Error</th>
                        <th>Controller</th>
                        <th>function</th>
                        <th>Baris Erro</th>
                        <th>Pesan Error</th>
                        <th>Status</th>
                        <th>Param</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td>Belum ada ERROR</td>
                        </tr>
                    @else
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->errors_date }}</td>
                                <td>{{ $item->controller }}</td>
                                <td>{{ $item->function }}</td>
                                <td>{{ $item->error_line }}</td>
                                <td>{{ $item->error_message }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->param }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
