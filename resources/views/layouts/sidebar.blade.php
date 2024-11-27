<nav class="sidebar sidebar-offcanvas" id="sidebar">
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
        <a class="nav-link" href="/detailpenerimaan">
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
  </nav>
