@extends('layout.main')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
{{--  <style>
    /* Styling form input */
    #inputForm {
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        max-width: 600px;
        margin: 0 auto;
    }

    #inputForm label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    #inputForm input, #inputForm button {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #inputForm button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    #inputForm button:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        margin-top: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
</style>  --}}
<h1>Daftar Pengguna</h1>

<div class="text-end mb-3">
    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
</div>
<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


<!-- Tabel pengguna -->
<table id="userTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nama_user }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-center">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var table = $('#userTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    text: 'Salin',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'csv',
                    text: 'Ekspor CSV',
                    className: 'btn btn-success'
                },
                {
                    extend: 'excel',
                    text: 'Ekspor Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdf',
                    text: 'Unduh PDF',
                    className: 'btn btn-danger',
                    title: 'Daftar Pengguna',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-info'
                }
            ]
        });

        // Menambah pengguna baru ketika form disubmit
        $('#inputForm').on('submit', function(event) {
            event.preventDefault();

            // Ambil data dari form
            var name = $('#name').val();
            var email = $('#email').val();

            // Tambahkan data ke tabel
            var rowCount = table.rows().count() + 1;
            table.row.add([rowCount, name, email, '<a href="#" class="btn btn-warning btn-sm">Edit</a> <button class="btn btn-danger btn-sm">Hapus</button>']).draw(false);

            // Reset form setelah submit
            $('#inputForm')[0].reset();
        });
    });
</script>

@endsection
