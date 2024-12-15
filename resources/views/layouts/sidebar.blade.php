<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Menu Dashboard, selalu muncul -->
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @php
            $userAccess = collect();
            if (Auth::check()) {
                $userAccess = \App\Models\Akses::where('role_id', Auth::user()->role_id)
                                              ->where('hak_akses', 'like', '%lihat%')
                                              ->pluck('menu_id'); // Mengambil daftar menu_id yang diizinkan
            }
        @endphp

        <!-- Menu khusus admin -->
        @if(Auth::check() && Auth::user()->role_id == 1) <!-- Admin -->
            <li class="nav-item">
                <a class="nav-link" href="/roles">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Role</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/kategori">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Kategori Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/barangs">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Master Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/menus">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Master Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/akses">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Kelola Akses Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/peminjaman">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Manajemen Peminjaman</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pengembalian">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Manajemen Pengembalian</span>
                </a>
            </li>
        @endif

        <!-- Menu khusus user -->
        @if(Auth::check() && Auth::user()->role_id == 2) <!-- User -->
            @php
                $menus = \App\Models\Menu::whereIn('id', $userAccess)->get(); // Ambil menu berdasarkan akses user
            @endphp
            @foreach($menus as $menu)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url($menu->link ?? '#') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">{{ $menu->nama_menu }}</span>
                    </a>
                </li>
            @endforeach
        @endif

        <!-- Menu tanpa autentikasi -->
        <li class="nav-item">
            <a class="nav-link" href="/barang/tersedia">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Barang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/peminjaman">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Peminjaman</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pengembalian">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Pengembalian</span>
          </a>
      </li>
    </ul>
</nav>




{{--  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      @if(Auth::user()->role_id == 1) <!-- Admin -->
      <li class="nav-item">
        <a class="nav-link" href="/roles">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Role</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/users">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">User</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/kategori">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Kategori Barang</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/barangs">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Master Barang</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/menus">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Master Menu</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/akses">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Kelola Akses Menu</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/peminjaman">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Manajemen Peminjaman</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/pengembalian">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Manajemen Pengembalian</span>
        </a>
    </li>

      @endif

      @if(Auth::user()->role_id == 2) <!-- User -->
      <li class="nav-item">
          <a class="nav-link" href="/peminjaman">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Peminjaman</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/pengembalian">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Pengembalian</span>
        </a>
    </li>
  @endif
    </ul>
  </nav>  --}}
