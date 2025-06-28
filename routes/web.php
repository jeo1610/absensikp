<?php

use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataAbsenController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\DataSubstansiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CekLogin;

// Login
Route::get('/', [LoginController::class, 'showLogin']);
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::get('/logout', [LoginController::class, 'logout']);

// Absensi
// Route::get('/absensi/qr-code', [AdminAbsensiController::class, 'qrcode'])->name('absensi.qr-code');
// Route::get('/absensi/qr-code-refresh', [AdminAbsensiController::class, 'qrCodeRefresh'])->name('absensi.qr-code.refresh');

// ====================
// Admin Area (Hanya untuk Admin)
// ====================
Route::middleware([CekLogin::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/laporan-absensi', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/admin/cetak-absensi', [AdminController::class, 'cetak'])->name('admin.cetak');

    // absensi
    Route::get('/admin/qr-code', [AdminAbsensiController::class, 'qrcode']);
    Route::get('/admin/qr-absensi/{jenis}/{id}', [AdminAbsensiController::class, 'tampilkanQrAbsensi']);
    Route::get('/admin/qr-absensi/qr-code-refresh', [AdminAbsensiController::class, 'qrCodeRefresh']);
    Route::get('/admin/reset-absensi', [AdminAbsensiController::class, 'resetAbsensi']);

    // admin
    Route::get('/admin/data-admin', [DataAdminController::class, 'dataadmin']);
    Route::get('/admin/data-admin/tambah', [DataAdminController::class, 'tambahadmin']);
    Route::post('/admin/data-admin/kirim', [DataAdminController::class, 'kirimadmin']);
    Route::get('/admin/data-admin/edit/{id}', [DataAdminController::class, 'editadmin']);
    Route::post('/admin/data-admin/update', [DataAdminController::class, 'updateadmin']);
    Route::get('/admin/data-admin/delete/{id}', [DataAdminController::class, 'deleteadmin']);

    // substansi
    Route::get('/admin/data-substansi', [DataSubstansiController::class, 'datasubstansi']);
    Route::get('/admin/data-substansi/tambah', [DataSubstansiController::class, 'tambahsubstansi']);
    Route::post('/admin/data-substansi/kirim', [DataSubstansiController::class, 'kirimsubstansi']);
    Route::get('/admin/data-substansi/edit/{id}', [DataSubstansiController::class, 'editsubstansi']);
    Route::post('/admin/data-substansi/update', [DataSubstansiController::class, 'updatesubstansi']);
    Route::get('/admin/data-substansi/delete/{id}', [DataSubstansiController::class, 'deletesubstansi']);

    // pegawai
    Route::get('/admin/data-pegawai', [DataPegawaiController::class, 'datapegawai']);
    Route::get('/admin/data-pegawai/tambah', [DataPegawaiController::class, 'tambahpegawai']);
    Route::post('/admin/data-pegawai/kirim', [DataPegawaiController::class, 'kirimpegawai']);
    Route::get('/admin/data-pegawai/edit/{id}', [DataPegawaiController::class, 'editpegawai']);
    Route::post('/admin/data-pegawai/update', [DataPegawaiController::class, 'updatepegawai']);
    Route::get('/admin/data-pegawai/delete/{id}', [DataPegawaiController::class, 'deletepegawai']);

    // absen
    Route::get('/admin/data-absen', [DataAbsenController::class, 'dataabsen']);
    Route::get('/admin/data-absen/tambah', [DataAbsenController::class, 'tambahabsen']);
    Route::post('/admin/data-absen/kirim', [DataAbsenController::class, 'kirimabsen']);
    Route::get('/admin/data-absen/edit/{id}', [DataAbsenController::class, 'editabsen']);
    Route::post('/admin/data-absen/update', [DataAbsenController::class, 'updateabsen']);
    Route::get('/admin/data-absen/delete/{id}', [DataAbsenController::class, 'deleteabsen']);
});

// ====================
// Pegawai Area (Hanya untuk Pegawai)
// ====================
Route::middleware([CekLogin::class . ':pegawai'])->group(function () {
    Route::get('/pegawai/dashboard', [PegawaiController::class, 'index']);
    Route::get('/pegawai/riwayat-absensi/{id}', [PegawaiController::class, 'riwayat']);
    Route::get('/pegawai/scan-qr', [PegawaiController::class, 'scanQr']);
    Route::get('/pegawai/proses-absensi', [PegawaiController::class, 'prosesAbsensi']);
});
