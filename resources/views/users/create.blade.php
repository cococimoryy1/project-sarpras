@extends('layout.main')

@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-10  mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <h1>Tambah Pengguna</h1>

                    <form id="addUserForm" method="POST" action="{{ route('users.store') }}">

                        @csrf
                        <div class="form-group">
                            <label for="nama_user">Nama:</label>
                            <input type="text" name="nama_user" class="form-control"
                                   {{--  value="{{ old('nama_user') }}"  --}}
                                   placeholder="Enter name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   {{--  value="{{ old('email') }}"  --}}
                                   placeholder="Enter email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control"
                                   placeholder="Enter password" required>
                        </div>

                        <div class="form-group">
                            <label for="id_jenis_user">Tipe Pengguna:</label>
                            <select name="id_jenis_user" class="form-select" id="id_jenis_user" required>
                                <option value="">Pilih Tipe Pengguna</option>
                                <option value="1">Admin</option>
                                <option value="2">Dosen</option>
                                <option value="3">Mahasiswa</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#addUserForm').on('submit', function (e) {
            e.preventDefault(); // Mencegah reload halaman

            var formData = $(this).serialize(); // Mengambil data form

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    alert('Pengguna berhasil ditambahkan!');
                    $('#addUserForm')[0].reset(); // Mengosongkan form
                },
                error: function (response) {
                    alert('Gagal menambahkan pengguna. Mohon periksa kembali form.');
                }
            });
        });
    });
</script>  --}}
@endsection
