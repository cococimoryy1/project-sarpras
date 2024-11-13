@extends('layout.main')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master MK</h3>
            </div>
            <!--/.card-header-->
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (Auth::user()->id_jenis_user == '1')
                    <form action="{{ route('simpan_master_mk') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kode_mk">Kode MK</label>
                            <input type="text" name="kode_mk" id="kode_mk" class="form-control" placeholder="Kode MK">
                        </div>
                        <div class="form-group">
                            <label for="nama_mk">Nama MK</label>
                            <input type="text" name="nama_mk" id="nama_mk" class="form-control" placeholder="Nama MK">
                        </div>
                        <div class="form-group">
                            <label for="sks">SKS</label>
                            <input type="number" name="sks" id="sks" class="form-control" placeholder="SKS">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                    <hr>
                @endif
                <!-- Tabel untuk menampilkan data MK -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode MK</th>
                                <th>Nama MK</th>
                                <th>SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masterMK as $mk)
                                <tr>
                                    <td>{{ $mk->kode_mk }}</td>
                                    <td>{{ $mk->nama_mk }}</td>
                                    <td>{{ $mk->sks }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/.card-body-->
        </div>
    </section>
@endsection
