<?php

use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CekLogin;

// Halaman Login
Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Absensi
Route::get('/absensi/qr-code', [AdminAbsensiController::class, 'qrcode'])->name('absensi.qr-code');
Route::get('/absensi/qr-code-refresh', [AdminAbsensiController::class, 'qrCodeRefresh'])->name('absensi.qr-code.refresh');

// ====================
// Admin Area (Hanya untuk Admin)
// ====================
Route::middleware([CekLogin::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/laporan-absensi', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/admin/cetak-absensi', [AdminController::class, 'cetak'])->name('admin.cetak');
    Route::get('/admin/qr-code', [AdminAbsensiController::class, 'qrcode'])->name('admin.qr-code');
    Route::get('/admin/qr-code-refresh', [AdminAbsensiController::class, 'qrCodeRefresh'])->name('admin.qr-code.refresh');
    Route::get('/absensi-masuk', [AdminAbsensiController::class, 'aktifkanAbsenMasuk'])->name('absensi.masuk.aktif');
    Route::get('/absensi-keluar', [AdminAbsensiController::class, 'aktifkanAbsenKeluar'])->name('absensi.keluar.aktif');
    Route::get('/reset-absensi', [AdminAbsensiController::class, 'resetAbsensi'])->name('absensi.reset');

    // admin
    Route::get('/admin/data-admin', [AdminController::class, 'dataadmin'])->name('admin.data-admin');
    Route::get('/admin/data-admin/tambah', [AdminController::class, 'tambahadmin'])->name('admin.tambah-data-admin');
    Route::post('/admin/data-admin/kirim', [AdminController::class, 'kirimadmin']);
    Route::get('/admin/data-admin/edit/{id}', [AdminController::class, 'editadmin'])->name('admin.edit-data-admin');
    Route::post('/admin/data-admin/update', [AdminController::class, 'updateadmin']);
    Route::get('/admin/data-admin/delete/{id}', [AdminController::class, 'deleteadmin']);

    // pegawai
    Route::get('/admin/data-pegawai', [AdminController::class, 'datapegawai'])->name('admin.data-pegawai');
    Route::get('/admin/data-pegawai/tambah', [AdminController::class, 'tambahpegawai'])->name('admin.tambah-data-pegawai');
    Route::post('/admin/data-pegawai/kirim', [AdminController::class, 'kirimpegawai']);
    Route::get('/admin/data-pegawai/edit/{id}', [AdminController::class, 'editpegawai'])->name('admin.edit-data-pegawai');
    Route::post('/admin/data-pegawai/update', [AdminController::class, 'updatepegawai']);
    Route::get('/admin/data-pegawai/delete/{id}', [AdminController::class, 'deletepegawai']);
});

// ====================
// Pegawai Area (Hanya untuk Pegawai)
// ====================
Route::middleware([CekLogin::class . ':pegawai'])->group(function () {
    Route::get('/pegawai/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
    Route::get('/pegawai/riwayat-absensi/{id}', [PegawaiController::class, 'riwayat'])->name('pegawai.riwayat');
    Route::get('/pegawai/scan-qr', [PegawaiController::class, 'scanQr'])->name('pegawai.scan.qr');
    Route::get('/pegawai/proses-absensi', [PegawaiController::class, 'prosesAbsensi'])->name('pegawai.proses-absensi');
});
