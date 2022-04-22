<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.post');

Route::middleware('authweb')->group(function () {
    Route::get('/dashboard', [RouteController::class, 'home'])->name('home');

    Route::resource('users', UserController::class)->middleware('roles:admin');
    Route::resource('menus', MenuController::class)->middleware('roles:admin');

    Route::get('/aktifitas-pegawai', [RouteController::class, 'aktifitas'])->name('aktifitas');
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan')->middleware('roles:admin');
    Route::get('/laporan-transaksi', [TransaksiController::class, 'dataLaporan'])->middleware('roles:admin');
    Route::resource('transaksis', TransaksiController::class)->middleware('roles:kasir');

    Route::post('/pesanan/bayar/{id}', [PesananController::class, 'bayar'])->middleware('roles:pelanggan')->name('pesanan.bayar');
    Route::resource('pesanan', PesananController::class)->middleware('roles:pelanggan');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
