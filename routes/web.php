<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AksesController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ManajemenPeminjamanController;
use App\Http\Controllers\ManajemenPengembalianController;

// Detail Peminjaman
Route::get('/peminjaman/{id}/detail', [PeminjamanController::class, 'showDetail'])->name('peminjaman.detail');

// Detail Pengembalian
Route::get('/pengembalian/{id}/detail', [PengembalianController::class, 'showDetail'])->name('pengembalian.detail');


Route::prefix('manajemen-peminjaman')->group(function () {
    Route::get('/', [ManajemenPeminjamanController::class, 'index']);
    Route::post('/{id}/terima', [ManajemenPeminjamanController::class, 'terima']);
    Route::delete('/{id}/tolak', [ManajemenPeminjamanController::class, 'tolak']);
});

Route::prefix('manajemen-pengembalian')->group(function () {
    Route::get('/', [ManajemenPengembalianController::class, 'index']);
    Route::post('/{id}/setuju', [ManajemenPengembalianController::class, 'setuju']);
});

Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');


// Route untuk login dan registrasi (untuk guest)
Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login');
    // Registrasi
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/proses-register', [RegisterController::class, 'register'])->name('register.post');
});

// Route untuk logout (untuk semua pengguna yang sudah login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
// Route untuk dashboard dan manajemen admin (hanya untuk admin)
Route::middleware([AdminMiddleware::class])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index']);

    // Buku Management
    Route::get('/buku', [BukuController::class, 'index']);
    Route::post('/addbuku', [BukuController::class, 'add_buku']);

    // Kategori Management
    Route::get('/kategori', [CategoryController::class, 'index']);
    Route::post('/addkategori', [CategoryController::class, 'add_kategori']);

    // Role Management
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // User Management
    Route::get('users', [UserController::class, 'index'])->name('users.index'); // Menampilkan daftar user
    Route::get('users/create', [UserController::class, 'create'])->name('users.create'); // Menampilkan form tambah user
    Route::post('users', [UserController::class, 'store'])->name('users.store'); // Menyimpan user baru
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Menampilkan form edit user
    Route::post('users/{id}', [UserController::class, 'update'])->name('users.update'); // Memperbarui user
    Route::post('users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy'); // Menghapus user

    // Menu Management
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

    // Peminjaman Management (admin)
    Route::get('/admin/peminjaman', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/peminjaman/{id}/acc', [AdminController::class, 'updateStatus'])->name('peminjaman.acc');
    Route::post('/admin/peminjaman/{id}/tolak', [AdminController::class, 'updateStatus'])->name('peminjaman.tolak');
});

// Route untuk user melakukan peminjaman (hanya untuk user)
Route::middleware('auth')->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'accPeminjaman'])->name('peminjaman.approve');
    Route::delete('/peminjaman/{id}/reject', [PeminjamanController::class, 'tolakPeminjaman'])->name('peminjaman.reject');
    Route::post('/peminjaman/{id}/return', [PeminjamanController::class, 'return'])->name('peminjaman.return');


    // Route untuk pengembalian
// Untuk melihat daftar peminjaman/pengembalian
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

// Untuk user mengajukan pengembalian
Route::post('/pengembalian/{peminjaman_id}', [PengembalianController::class, 'store'])->name('pengembalian.store');

// Untuk admin menyetujui pengembalian
Route::post('/pengembalian/approve/{peminjaman_id}', [PengembalianController::class, 'accPengembalian'])->name('pengembalian.acc');

Route::get('menus/{menu}/akses', [AksesController::class, 'create'])->name('akses.create');
Route::post('menus/{menu}/akses', [AksesController::class, 'store'])->name('akses.store');

});


// Route untuk resource Barang (hanya untuk admin atau sesuai dengan kebutuhan)
Route::resource('barangs', BarangController::class)->middleware(['auth']); // Bisa ditambahkan middleware yang sesuai
