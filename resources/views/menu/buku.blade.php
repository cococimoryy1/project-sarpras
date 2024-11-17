@extends('layouts.main')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card position-relative">
                        <div class="card-body">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Tambahkan Koleksi Buku Baru</h3>
                            </div>
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Daftar Buku</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="example" class="display expandable-table" style="width:100%">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
