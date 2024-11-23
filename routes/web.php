<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Models\Buku;
use App\Models\Category;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Route::get('/login', function () {
//     return view('login');
// });
// Rute untuk menampilkan form login
Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login');
    // registrasi
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/proses-register', [RegisterController::class, 'register'])->name('register.post');
});

// Rute untuk logout

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([AdminMiddleware::class])->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/buku', [BukuController::class, 'index']);
Route::post('/addbuku', [BukuController::class, 'add_buku']);

Route::get('/kategori', [CategoryController::class, 'index']);
Route::post('/addkategori', [CategoryController::class, 'add_kategori']);

//Role
Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

//Users
Route::get('users', [UserController::class, 'index'])->name('users.index'); // Menampilkan daftar user
Route::get('users/create', [UserController::class, 'create'])->name('users.create'); // Menampilkan form tambah user
Route::post('users', [UserController::class, 'store'])->name('users.store'); // Menyimpan user baru
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Menampilkan form edit user
Route::post('users/{id}', [UserController::class, 'update'])->name('users.update'); // Memperbarui user
Route::post('users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy'); // Menghapus user

//Menu
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');  // Menampilkan daftar menu (GET)
Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');  // Menampilkan form tambah menu (GET)
Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');  // Menyimpan menu baru (POST)
Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');  // Menampilkan form edit menu (GET)
Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');  // Memperbarui menu (PUT)
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');  // Menghapus menu (DELETE)
});



Route::resource('barang', BarangController::class);