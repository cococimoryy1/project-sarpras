<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('dist/img/logo_unair.png') }}" alt="Admin User" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Universitas Airlangga</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/ShelyComel.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Shelyna Riska</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{--  @if (Auth::user()->id_jenis_user == '')  --}}
                <li class="nav-item">
                    <a href="{{ url('/dashboard2') }}"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <li class="nav-item {{ request()->is('email') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ request()->is('master*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Buku
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/buku') }}"
                                    class="nav-link {{ request()->is('master-mhs') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Buku</p>
                                </a>
                            <li class="nav-item">
                                <a href="{{ url('/kategori') }}"
                                    class="nav-link {{ request()->is('master-mhs') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    </li>
                {{--  @ifelse(Auth::user()->id_jenis_user== 'mahasiswas')  --}}
                <li class="nav-item">
                    <a href="{{ url('/profile/' . Auth::id()) }}"
                        class="nav-link {{ request()->is('profile*') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                {{--  @endif  --}}
                <li class="nav-item">
                    <li class="nav-item {{ request()->is('email') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ request()->is('master*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Menu Tambahan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('/gempa') }}"
                        class="nav-link {{ request()->is('gempa') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Gempa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/Datatable') }}"
                        class="nav-link {{ request()->is('gempa') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Datatable
                        </p>
                    </a>
                </li> <li class="nav-item">
                    <a href="{{ url('/linechart') }}"
                        class="nav-link {{ request()->is('gempa') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Chart
                        </p>
                    </a>
                </li> <li class="nav-item">
                    <a href="{{ url('/html2pdf') }}"
                        class="nav-link {{ request()->is('gempa') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            HTML PDF
                        </p>
                    </a>
                </li>
            </li>
        </ul>
    </li>
    </li>

                <!-- Menu Mahasiswa -->
                @if (Auth::user()->id_jenis_user == '1' || Auth::user()->id_jenis_user == '2')
                    <li class="nav-item {{ request()->is('master*') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ request()->is('master*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Mahasiswa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/master-mhs') }}"
                                    class="nav-link {{ request()->is('master-mhs') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Mahasiswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/master-MK') }}"
                                    class="nav-link {{ request()->is('master-MK') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master MK</p>
                                </a>
                            </li>
                            {{--  <li class="nav-item">
                                <a href="{{ url('/master-kelas') }}"
                                    class="nav-link {{ request()->is('master-kelas') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Kelas</p>
                                </a>
                            </li>  --}}
                            <li class="nav-item">
                                <a href="{{ url('/master-dosen') }}"
                                    class="nav-link {{ request()->is('master-dosen') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master Dosen</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Menu Perkuliahan -->
                    <li class="nav-item {{ request()->is('perkuliahan*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('perkuliahan*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Perkuliahan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{--  <li class="nav-item">
                                <a href="{{ url('/perkuliahan-jadwalkuliah') }}"
                                    class="nav-link {{ request()->is('perkuliahan-jadwalkuliah') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Kuliah</p>
                                </a>
                            </li>  --}}
                            <li class="nav-item">
                                <a href="{{ url('/perkuliahan-absensi_mhs') }}"
                                    class="nav-link {{ request()->is('perkuliahan-absensi_mhs') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Absensi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/perkuliahan-nilaimahasiswa') }}"
                                    class="nav-link {{ request()->is('perkuliahan-nilaimahasiswa') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nilai Mahasiswa</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    </li>
                @endif
                <!-- Menu untuk Admin -->
                @if (Auth::user()->id_jenis_user == '1')
                    <li class="nav-item">
                        <a href="{{ url('/log-activity') }}"
                            class="nav-link {{ request()->is('log-activity') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Log Activity
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/log-errors') }}"
                            class="nav-link {{ request()->is('log-errors') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Log Errors
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('master*') ? 'menu-open' : '' }} ">
                        <a href="#" class="nav-link {{ request()->is('master*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Data User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/users') }}"
                                    class="nav-link {{ request()->is('users.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add User</p>
                                </a>
                            <li class="nav-item">
                                <a href="{{ url('/jenis_user') }}"
                                    class="nav-link {{ request()->is('Role') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Role</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
                            <li class="nav-item">
                                <a href="{{ url('/menu') }}"
                                    class="nav-link {{ request()->is('log-errors') ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                      Menu User
                                    </p>
                                </a>
                            </li>
                        </li> --}}
                    <li class="nav-item">
                    <li class="nav-item">
                        <a href="{{ route('aksesMenu.index') }}"
                            class="nav-link {{ request()->is('log-errors') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Setting Menu
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                <li class="nav-item {{ request()->is('email') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ request()->is('master*') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Email
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/email/create') }}"
                                class="nav-link {{ request()->is('master-mhs') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Send Email</p>
                            </a>
                        <li class="nav-item">
                            <a href="{{ url('/email/inbox') }}"
                                class="nav-link {{ request()->is('master-mhs') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox Email</p>
                            </a>
                        </li>
                    </ul>
                </li>
                </li>

                {{--  @foreach ($navbar as $item)
                <li class="nav-item">
                    @php
                        $route = $item->menu->menu_link;
                    @endphp
                    @try
                        <a href="{{ route($route) }}" class="nav-link {{ request()->is($route) ? 'active' : '' }}">
                            <i class="nav-icon {{ $item->menu->menu_icon }}"></i>
                            <p>{{ $item->menu->menu_name }}</p>
                        </a>
                    @catch (\Symfony\Component\Routing\Exception\RouteNotFoundException $e)
                        <a href="{{ route('404') }}" class="nav-link">
                            <i class="nav-icon {{ $item->menu->menu_icon }}"></i>
                            <p>{{ $item->menu->menu_name }} (not found)</p>
                        </a>
                    @endtry
                </li>
            @endforeach  --}}

                <!-- Menu Lainnya -->
                <li class="nav-item">
                    <a href="{{ url('/logout') }}"
                        class="nav-link {{ request()->is('admin/cities') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>



                @foreach ($navbar as $item)
                    <li class="nav-item">
                        <a href=""
                            class="nav-link {{ request()->is('admin/cities') ? 'active' : '' }}">
                            <i class="nav-icon {{ $item->menu->menu_icon }}"></i>
                            <p>
                                {{ $item->menu->menu_name }}
                            </p>
                        </a>
                    </li>
                @endforeach

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
