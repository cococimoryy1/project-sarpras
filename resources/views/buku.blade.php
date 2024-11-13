@extends('layout.main')

@section('content')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons JavaScript and dependencies -->
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0; /* Hapus margin pada body */
            padding: 0; /* Hapus padding pada body */
        }
        .main-panel {
            height: 100vh; /* Pastikan panel utama menggunakan tinggi penuh */
        }
        .container-fluid {
            height: 100%; /* Pastikan container fluid juga menggunakan tinggi penuh */
        }
        .card {
            margin-bottom: 0; /* Hapus margin bawah pada card */
            height: auto; /* Sesuaikan tinggi card dengan konten */
        }
    </style>

    <div class="container-fluid p-4">
        <!-- Tambahkan Koleksi Buku Form -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h3 class="font-weight-bold">Tambahkan Koleksi Buku Baru</h3>
            </div>
            <div class="card-body">
                <form method="post" class="forms-sample" action="/addbuku">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode Buku</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="ex : NV-01">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select class="form-select" name="id_kategori" id="id_kategori">
                            @foreach ($kategori as $category)
                                <option value="{{ $category->id_kategori }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Nama Pengarang">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="/buku" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>

        <!-- Daftar Buku -->
        <div class="card shadow-sm w-100">
            <div class="card-body">
                <p class="card-title">Daftar Buku</p>
                <div class="table-responsive w-100">
                    <table id="example" class="display expandable-table w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Kategori Buku</th>
                                <th>Pengarang</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>{{ $item->pengarang }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'copyHtml5', text: 'Copy', className: 'btn btn-outline-primary' },
                    { extend: 'csvHtml5', text: 'CSV', className: 'btn btn-outline-primary' },
                    { extend: 'excelHtml5', text: 'Excel', className: 'btn btn-outline-primary' },
                    { extend: 'pdfHtml5', text: 'PDF', className: 'btn btn-outline-primary' },
                    { extend: 'print', text: 'Print', className: 'btn btn-outline-primary' }
                ],
                language: {
                    searchPlaceholder: "Cari buku...",
                    search: "",
                    lengthMenu: "Tampilkan _MENU_ buku",
                    zeroRecords: "Buku tidak ditemukan",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ buku",
                    infoEmpty: "Tidak ada buku yang tersedia",
                    infoFiltered: "(disaring dari _MAX_ buku)"
                }
            });
        });
    </script>
@endsection
