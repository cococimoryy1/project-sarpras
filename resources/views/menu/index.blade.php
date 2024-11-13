@extends('layout.main')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h5>Daftar Menu</h5>
                        <a href="{{ route('menu.create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>

                    <table id="menuTable" class="display">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Link</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allMenu as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->menu_name }}</td>
                                    <td>{{ $item->menu_link }}</td>
                                    <td>
                                        <i class="{{ $item->menu_icon }}"></i>
                                    </td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal"
                                           class="btn btn-sm btn-primary"
                                           data-bs-target="#staticBackdrop{{ $item->id }}">Edit</a>
                                        <form action="{{ route('menu.delete', $item->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Menu Modal -->
<div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- AJAX Update Menu Form -->
                <form id="editMenuForm-{{ $item->id }}" method="POST" action="{{ route('menu.update', $item->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="menu_name_{{ $item->id }}">Nama Menu</label>
                        <input type="text" class="form-control"
                               id="menu_name_{{ $item->id }}" name="menu_name"
                               value="{{ $item->menu_name }}">
                    </div>
                    <div class="form-group">
                        <label for="menu_link_{{ $item->id }}">Link Menu</label>
                        <input type="text" class="form-control"
                               id="menu_link_{{ $item->id }}" name="menu_link"
                               value="{{ $item->menu_link }}">
                    </div>
                    <div class="form-group">
                        <label for="menu_icon_{{ $item->id }}">Icon Menu</label>
                        <input type="text" class="form-control"
                               id="menu_icon_{{ $item->id }}" name="menu_icon"
                               value="{{ $item->menu_icon }}">
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-menu" data-id="{{ $item->id }}">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>




    {{--  <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h5>Daftar Menu</h5>
                        <a href="{{ route('menu.create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>

                    <table id="menuTable" class="display">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Link</th>
                                <th scope="col">Icon</th>
                            </tr>
                        </thead>

                        <tbody>
                            <table id="simpleTable" class="display">
                                @foreach ($allMenu as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->menu_name }}</td>
                                        <td>{{ $item->menu_link }}</td>
                                        <td>
                                            <i class="{{ $item->menu_icon }}"></i>
                                        </td>
                                        <td>
                                            <a href="{{ route('menu.edit', $item->id) }}" data-bs-toggle="modal"
                                                class="btn btn-sm btn-primary"
                                                data-bs-target="#staticBackdrop{{ $item->id }}">Edit</a>
                                            <form action="{{ route('menu.delete', $item->id) }}" method="getj">
                                                @csrf
                                                <input type="submit" class="btn btn-sm btn-danger" value="delete">
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Menu Modal -->
                                    {{--  <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit
                                                        Menu</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- AJAX Update Menu Form -->
                                                    <form id="editMenuForm-{{ $item->id }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="menu_name_{{ $item->id }}">Nama Menu</label>
                                                            <input type="text" class="form-control"
                                                                id="menu_name_{{ $item->id }}" name="menu_name"
                                                                value="{{ $item->menu_name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="menu_link_{{ $item->id }}">Link Menu</label>
                                                            <input type="text" class="form-control"
                                                                id="menu_link_{{ $item->id }}" name="menu_link"
                                                                value="{{ $item->menu_link }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="menu_icon_{{ $item->id }}">Icon Menu</label>
                                                            <input type="text" class="form-control"
                                                                id="menu_icon_{{ $item->id }}" name="menu_icon"
                                                                value="{{ $item->menu_icon }}">
                                                        </div>
                                                    </form>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary update-menu"
                                                            data-id="{{ $item->id }}">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>  --}}

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMenu" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Menu</label>
                            <input type="text" class="form-control" name="menu_name" placeholder="blablabla">
                        </div>
                        <div class="form-group">
                            <label for="">Link Menu</label>
                            <input type="text" class="form-control" name="menu_link" placeholder="/blabl/abla">
                        </div>
                        <div class="form-group">
                            <label for="">Icon Menu</label>
                            <input type="text" class="form-control" name="menu_icon"
                                placeholder="<i class='fa-contoh fa-contoh'></i>">
                        </div>
                        <p class="mt-3 fw-bold">Icon menu bisa didapat di <a target="_blank"
                                href="https://fontawesome.com/search?o=r&m=free">sini</a></p>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Kontainer Akses Menu -->
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Akses Menu</h5>
                        <a data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    <div class="accordion" id="jenisUser Accordion">
                        @foreach ($ppp as $menuUser)
                            <div class="card mb-2">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $menuUser->menu->menu_name }}</h6>
                                    <a href="{{ route('aksesMenu.delete', $menuUser->id) }}"
                                        class="btn btn-sm btn-danger">Remove Access</a>
                                </div>
                                <div class="card-body">
                                    <p><strong>Link:</strong> <a href="{{ $menuUser->menu->menu_link }}"
                                            target="_blank">{{ $menuUser->menu->menu_link }}</a></p>
                                    <p><strong>Icon:</strong> <i class="{{ $menuUser->menu->menu_icon }} fa-lg"></i></p>
                                    <p><strong>Jenis User:</strong> {{ $menuUser->user->username }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Access</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('aksesMenu.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Jenis User</label>
                            <select name="user_id" class="form-select" id="user_id">
                                <option value="">pilih user</option>
                                @foreach ($jenis_user as $item)
                                    <option value="{{ $item->id_jenis_user }}">{{ $item->jenis_user }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Berikan akses menu ke</label>
                            <select name="menu_id" class="form-select" id="menu_id">
                                <option value="">Pilih menu</option>
                                @foreach ($allMenu as $menuUser)
                                    <option value="{{ $menuUser->id }}">{{ $menuUser->menu_name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- add menu --}}
    <script>
        $(document).ready(function() {
            $('#simpleTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
        $(document).ready(function() {
            $('#menuTable').DataTable({
                dom: 'Bfrtip', // Pengaturan posisi tombol
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print' // Tombol ekspor
                ]
            });


            // Fungsi untuk menambah menu
            $('#addMenu').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('menu.create') }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#staticBackdrop').modal('hide');
                        Swal.fire({
                            title: "Menu Added",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            title: "Error",
                            text: "Failed to add the menu",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });

            // Fungsi untuk mengedit menu
            $('.update-menu').click(function() {
                var id = $(this).data('id');
                var menu_name = $('#menu_name_' + id).val();
                var menu_link = $('#menu_link_' + id).val();
                var menu_icon = $('#menu_icon_' + id).val();

                $.ajax({
                    url: 'AksesMenu/update/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        menu_name: menu_name,
                        menu_link: menu_link,
                        menu_icon: menu_icon
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            // Update data pada tabel tanpa refresh halaman
                            $('#menu-' + id).find('td:nth-child(2)').text(menu_name);
                            $('#menu-' + id).find('td:nth-child(3)').text(menu_link);
                            $('#menu-' + id).find('td:nth-child(4) i').attr('class', menu_icon);
                            $('#staticBackdrop' + id).modal('hide');
                            Swal.fire({
                                title: "Success",
                                text: "Edit Berhasil",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/admin/AksesMenu";
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error",
                            text: "Failed to update the menu",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });
    </script>
@endsection
