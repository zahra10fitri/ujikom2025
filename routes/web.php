<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\berandaController;
use App\Http\Controllers\GambarProdukController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberProdukController;
use Illuminate\Auth\Events\Login;

Route::get('/', function () {
    return view('beranda');
});
Route::get('/', [berandaController::class, 'index'])->name('beranda');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

});


Route::get('/toko', [DashboardController::class, 'toko'])->name('toko');
//admin user
Route::get('admin/user', [UserController::class, 'index'])->name('admin.user');
Route::get('admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('admin/user', [UserController::class, 'store'])->name('admin.user.store');
Route::get('admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::put('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
//admin toko
Route::get('/admin/toko', [TokoController::class, 'index'])->name('admin.toko');
Route::get('/admin/toko/create', [TokoController::class, 'create'])->name('admin.toko.create');
Route::post('/admin/toko', [TokoController::class, 'store'])->name('admin.toko.store');
Route::get('/admin/toko/{id_toko}/edit', [TokoController::class, 'edit'])->name('admin.toko.edit');
Route::put('/admin/toko/{id_toko}', [TokoController::class, 'update'])->name('admin.toko.update');
Route::delete('/admin/toko/{id_toko}', [TokoController::class, 'destroy'])->name('admin.toko.destroy');
//admin produk
Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk');
Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create');
Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
Route::get('/admin/produk/{id_produk}/edit', [ProdukController::class, 'edit'])->name('admin.produk.edit');
Route::put('/admin/produk/{id_produk}', [ProdukController::class, 'update'])->name('admin.produk.update');
Route::delete('/admin/produk/{id_produk}', [ProdukController::class, 'destroy'])->name('admin.produk.delete');
//admin kategori
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
Route::get('/admin/kategori/{id_kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
Route::put('/admin/kategori/{id_kategori}', [KategoriController::class, 'update'])->name('admin.kategori.update');
Route::delete('/admin/kategori/{id_kategori}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

Route::get('/admin/gambar-produk', [GambarProdukController::class, 'index'])->name('admin.gambar-produk');
Route::get('/admin/gambar-produk/create', [GambarProdukController::class, 'create'])->name('admin.gambar-produk.create');
Route::post('/admin/gambar-produk/store', [GambarProdukController::class, 'store'])->name('admin.gambar-produk.store');
Route::get('/admin/gambar-produk/{id}/edit', [GambarProdukController::class, 'edit'])->name('admin.gambar-produk.edit');
Route::post('/admin/gambar-produk/{id}/update', [GambarProdukController::class, 'update'])->name('admin.gambar-produk.update');
Route::get('/admin/gambar-produk/{id}/delete', [GambarProdukController::class, 'destroy'])->name('admin.gambar-produk.delete');

Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

//member
Route::middleware('member')->group(function () {
    // Dashboard
    Route::get('/member/dashboard', [MemberController::class, 'index'])->name('member.dashboard');

    // Toko member
    Route::get('/member/toko/create', [MemberController::class, 'create'])->name('member.toko.create');
     Route::get('/member/toko/create', [MemberController::class, 'createToko'])
    ->name('member.toko.create');
    Route::get('/member/produk', [MemberProdukController::class, 'index'])->name('member.produk');

    // Form tambah produk
    Route::get('/member/produk/create', [MemberProdukController::class, 'create'])->name('member.produk.create');

    // Proses simpan produk
    Route::post('/member/produk/store', [MemberProdukController::class, 'store'])->name('member.produk.store');
    Route::post('/member/toko/create', [MemberController::class, 'storeToko'])->name('member.toko.store');

    Route::get('/member/toko/{id}/edit', [MemberController::class, 'edit'])->name('member.toko.edit');
    Route::put('/member/toko/{id}', [MemberController::class, 'update'])->name('member.toko.update');

    Route::get('/member/produk', [MemberController::class, 'produkIndex'])->name('member.produk.index');
    Route::get('/member/produk/create', [MemberController::class, 'createProduk'])->name('member.produk.create');
    Route::post('/member/produk/store', [MemberController::class, 'storeProduk'])->name('member.produk.store');
    Route::get('/member/toko/{id}/edit', [MemberController::class, 'editToko'])->name('member.toko.edit');
    Route::post('/member/produk/update/{id}', [MemberController::class, 'updateProduk'])->name('member.produk.update');
    Route::delete('/member/produk/delete/{id}', [MemberController::class, 'deleteProduk'])->name('member.produk.delete');


});


//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/proses', [LoginController::class, 'login'])->name('login.proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//register
 Route::get('/register', [LoginController::class, 'register'])->name('register');
 Route::post('/register/proses', [LoginController::class, 'registerproses'])->name('register.proses');

// Menampilkan member pending
Route::get('/admin/user/pending', [UserController::class, 'pending'])->name('admin.user.pending');

// Approve member
Route::post('/admin/user/{id}/approve', [UserController::class, 'approve'])->name('admin.user.approve');
