<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GambarProdukController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/toko', [DashboardController::class, 'toko'])->name('toko');

Route::get('admin/user', [UserController::class, 'index'])->name('admin.user');
Route::get('admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('admin/user', [UserController::class, 'store'])->name('admin.user.store');
Route::get('admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::put('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

Route::get('/admin/toko', [TokoController::class, 'index'])->name('admin.toko');
Route::get('/admin/toko/create', [TokoController::class, 'create'])->name('admin.toko.create');
Route::post('/admin/toko', [TokoController::class, 'store'])->name('admin.toko.store');
Route::get('/admin/toko/{id_toko}/edit', [TokoController::class, 'edit'])->name('admin.toko.edit');
Route::put('/admin/toko/{id_toko}', [TokoController::class, 'update'])->name('admin.toko.update');
Route::delete('/admin/toko/{id_toko}', [TokoController::class, 'destroy'])->name('admin.toko.destroy');

Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk');
Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create');
Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
Route::get('/admin/produk/{id_produk}/edit', [ProdukController::class, 'edit'])->name('admin.produk.edit');
Route::put('/admin/produk/{id_produk}', [ProdukController::class, 'update'])->name('admin.produk.update');
Route::delete('/admin/produk/{id_produk}', [ProdukController::class, 'destroy'])->name('admin.produk.delete');

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