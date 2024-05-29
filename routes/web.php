<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfilePelangganController;
use App\Http\Controllers\RiwayatPesananController;
use App\Http\Controllers\SatuanController;
use App\Http\Livewire\Barang\Index;
use App\Http\Livewire\Shop\Cart;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/do-login', [LoginController::class, 'dologin'])->name('dologin');
Route::get('/do-logout', [LoginController::class, 'dologout'])->name('dologout');

// Route::get('/', function () {
//   return redirect('/login');
// });
Route::get('/', Index::class)->name('home')->middleware('auth');
Route::get('/cart', Cart::class)->name('shop.cart')->middleware('auth');

Route::prefix('admin')->group(function () {
  Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('pesanan', PesananController::class);
    Route::get('/pesanan/{pesanan}/check', [PesananController::class, 'check'])->name('pesanan.check');
    Route::get('/pesanan/{pesanan}/proses', [PesananController::class, 'proses'])->name('pesanan.proses');
    Route::get('/pesanan/{pesanan}/kirim', [PesananController::class, 'kirim'])->name('pesanan.kirim');
    Route::get('/pesanan/{pesanan}/selesai', [PesananController::class, 'selesai'])->name('pesanan.selesai');
  });

  Route::get('/getbarang/{id}', [BarangController::class, 'getbarang']);
});

Route::get('/profile', [ProfilePelangganController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile', [ProfilePelangganController::class, 'update'])->name('update.profile')->middleware('auth');

// riwayat pesanan
Route::get('/riwayat-pesanan', [RiwayatPesananController::class, 'index'])->name('riwayat.pesanan')->middleware('auth');
Route::get('/detail-riwayat-pesanan/{id}', [RiwayatPesananController::class, 'detail'])->name('detail.riwayat.pesanan')->middleware('auth');
