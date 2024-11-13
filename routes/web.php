<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LoadNavbarMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CuacaController;
use App\Http\Controllers\JenisUserController;
use App\Http\Controllers\LogErrorController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PerkuliahanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MasterDosenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MenuSettingController;
use App\Http\Controllers\MenuUserController;



// Rute untuk menampilkan form login
Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/authenticate', [LoginController::class, 'login'])->name('login');
    // registrasi
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/proses-register', [RegisterController::class, 'register'])->name('register.post');
});


// Rute untuk logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([AdminMiddleware::class, LoadNavbarMiddleware::class])->group(function () {

    Route::get('/log-errors', [LogErrorController::class, 'index']);
    Route::get('/log-activity', [UserActivityController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'Dashboard']);
    Route::get('/dashboard2', [DashboardController::class, 'chart'])->name('dashboard2.index');

    // Rute untuk pengaturan ulang kata sandi
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Rute untuk master data
    Route::get('/mahasiswa', [MasterController::class, 'index'])->name('mahasiswa.index');
    Route::post('/submitmhs', [MasterController::class, 'submitMahasiswa'])->name('submitmhs');
    Route::delete('/deletemhs/{id}', [MasterController::class, 'destroy'])->name('deletemhs');
    Route::post('/updatemhs/{id}', [MasterController::class, 'update'])->name('updatemhs');
    //master mahasiswa
    Route::get('/master-mhs', [MasterController::class, 'mastermhs'])->name('mastermhs');
    Route::get('/master-MK', [MasterController::class, 'masterMK'])->name('masterMK');
    Route::get('/master-kelas', [MasterController::class, 'masterkelas'])->name('masterkelas');
    Route::get('/master-dosen', [MasterDosenController::class, 'masterDosen'])->name('masterdosen');
    Route::get('/editmhs', [MasterController::class, 'edit'])->name('editmhs');


    //delete master mahasiswa
    Route::delete('deletemhs/{nim}', [App\Http\Controllers\MasterController::class, 'destroy'])->name('deletemhs.destroy');


    // Route untuk master dosen
    // Route::get('/masterdosen', [MasterDosenController::class, 'index'])->name('masterdosen');
    Route::post('/simpan-master-dosen', [MasterDosenController::class, 'simpanMasterDosen'])->name('simpan_master_dosen');

    // Route untuk menyimpan master kelas
    Route::post('/simpan-master-kelas', [MasterController::class, 'simpanMasterKelas'])->name('simpan_master_kelas');
    //delte master kelas
    Route::delete('/delete-master-kelas/{id}', [MasterController::class, 'deleteMasterKelas'])->name('delete_master_kelas');


    // Route untuk menyimpan master MK
    Route::post('/simpan-master-mk', [MasterController::class, 'simpanMasterMk'])->name('simpan_master_mk');

    // Rute untuk perkuliahan
    Route::get('/perkuliahan-jadwalkuliah', [PerkuliahanController::class, 'jadwalkuliah'])->name('jadwalkuliah');
    Route::get('/jadwalkuliah/edit/{id}', [PerkuliahanController::class, 'editJadwal'])->name('edit_jadwal');

    Route::put('/jadwal/update/{id}', [MasterController::class, 'updateJadwal'])->name('update_jadwal');

    Route::get('/perkuliahan-jadwalujian', [PerkuliahanController::class, 'jadwal_ujian'])->name('jadwalujian');
    Route::get('/perkuliahan-absensi_mhs', [PerkuliahanController::class, 'absensi_mhs'])->name('absensi_mhs');
    Route::get('/perkuliahan-nilaimahasiswa', [PerkuliahanController::class, 'nilaimhs'])->name('nilaimahasiswa');
    Route::get('/perkuliahan-test_method', [PerkuliahanController::class, 'test_method'])->name('test_method');

    //menyimpan jadwal kuliah
    Route::post('/simpan-jadwal', [PerkuliahanController::class, 'simpanjadwal'])->name('simpan_jadwal');
    // Route untuk menyimpan absensi
    Route::post('/simpan-absen', [PerkuliahanController::class, 'store_absen'])->name('simpan-absen');

    // Route untuk menyimpan nilai
    Route::post('/simpan-nilai', [PerkuliahanController::class, 'simpanNilai'])->name('simpan.nilai');

    // Rute untuk pengaturan ulang kata sandi
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('/profile/{id}', [ProfileController::class, 'index']);
    Route::post('/profile-update/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware([AdminMiddleware::class, LoadNavbarMiddleware::class])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/menu', [MenuSettingController::class, 'index'])->name('menu.index');       // Tampilkan semua menu
    Route::get('/menu/create', [MenuSettingController::class, 'create'])->name('menu.create'); // Form untuk tambah menu
    Route::post('/menu/store', [MenuSettingController::class, 'store'])->name('menu.store');   // Simpan menu baru
    Route::get('/menu/{id}/edit', [MenuSettingController::class, 'edit'])->name('menu.edit');  // Form untuk edit menu
    Route::post('/menu/{id}/update', [MenuSettingController::class, 'update'])->name('menu.update'); // Update menu
    Route::get('/menu/{id}/delete', [MenuSettingController::class, 'delete'])->name('menu.delete'); // Hapus menu

    Route::get('AksesMenu', [MenuUserController::class, 'index'])->name('aksesMenu.index');
    Route::post('AksesMenu/store', [MenuUserController::class, 'store'])->name('aksesMenu.store');
    Route::post('AksesMenu/update/{id}', [MenuUserController::class, 'update'])->name('aksesMenu.update');
    Route::get('AksesMenu/delete/{id}', [MenuUserController::class, 'delete'])->name('aksesMenu.delete');


    Route::resource('jenis_user', JenisUserController::class);
    // Route::get('/{id}/{menu_name}', [Men::class, 'showMenu'])->name('aksesMenu.show');

});

Route::middleware(LoadNavbarMiddleware::class)->group(function(){
    Route::get('/gempa', function () {
    return view('gempa');
});

    Route::get('/email/create', [EmailController::class, 'create'])->middleware('auth');
    Route::post('/email/send', [EmailController::class, 'send'])->middleware('auth');
    Route::get('/email/inbox', [EmailController::class, 'inbox'])->name('email.inbox');
    // Route::get('/email/view/{message_id}', [EmailController::class, 'view'])->name('email.view');
    Route::get('/email/{id}', [EmailController::class, 'show'])->name('email.show');
    Route::post('/email/reply/{id}', [EmailController::class, 'reply'])->name('email.reply');
    Route::get('/Datatable',function(){
        return view('datatable');});
    Route::get('/linechart',function(){
        return view('chart');});
    Route::get('/html2pdf',function(){
            return view('html2pdf');});
    // Route::fallback(function () {
    //  return view('errors.404'); // Pastikan Anda memiliki tampilan untuk 404
    //   });

    Route::get('/buku', [BukuController::class, 'index']);
Route::post('/addbuku', [BukuController::class, 'add_buku']);

Route::get('/kategori', [CategoryController::class, 'index']);
Route::post('/addkategori', [CategoryController::class, 'add_kategori']);
Route::get('/transaksi', [DashboardController::class, 'transaksi'])->name('transaksi');

});


