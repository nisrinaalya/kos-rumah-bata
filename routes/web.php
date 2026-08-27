<?php

use App\Http\Controllers\Admin\AdminKamarController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminActivityController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminMaintenanceController;
use App\Http\Controllers\Admin\AdminPembayaranController;
use App\Http\Controllers\Admin\AdminPenghuniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PengajuanSewaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// User
Route::get('/', [HomeController::class, 'index']);
Route::get('/aktivitas', [HomeController::class, 'activity']);
Route::get('/tentang-kami', [HomeController::class, 'galeri']);

// Kamar
Route::get('/kamar', [KamarController::class, 'index']);
Route::get('/kamar/{id}', [KamarController::class, 'show']);

Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'getRegister']);
    Route::post('/register', [AuthController::class, 'postRegister']);

    // Login
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::get('/logout', [AuthController::class, 'getLogout']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::put('/profile', [ProfileController::class, 'updateProfile']);
    Route::put('/profile/password', [ProfileController::class, 'updatePassword']);
    Route::get('/profile/status-pembayaran', [ProfileController::class, 'statusPembayaran']);

    Route::get('/profile/laporan-fasilitas', [MaintenanceController::class, 'index']);
    Route::post('/profile/laporan-fasilitas', [MaintenanceController::class, 'store']);

    // Flow Sewa
    Route::get('/kamar/{id}/ajukan-sewa', [PengajuanSewaController::class, 'create']);
    Route::post('/kamar/{id}/ajukan-sewa', [PengajuanSewaController::class, 'store']);
    Route::get('/pembayaran/{order_id}', [PengajuanSewaController::class, 'show']);
    Route::post('/pembayaran/{order_id}', [PengajuanSewaController::class, 'payment']);
});

Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index']);

    // CRUD Kamar Admin
    Route::resource('/kamar', AdminKamarController::class);

    // Penghuni
    Route::get('/penghuni/pdf', [AdminPenghuniController::class, 'pdf']);
    Route::resource('/penghuni', AdminPenghuniController::class);

    // Pembayaran
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index']);
    Route::get('/pembayaran/{order_id}', [AdminPembayaranController::class, 'show']);
    Route::put('/pembayaran/{order_id}/verifikasi', [AdminPembayaranController::class, 'verifikasi']);

    // CRUD Maintenance Admin
    Route::resource('/maintenance', AdminMaintenanceController::class);

    // CRUD FAQ Admin
    Route::resource('/konten/faq', AdminFaqController::class);

    // CRUD Activity Admin
    Route::resource('/konten/activity', AdminActivityController::class);

    // CRUD Galeri Admin
    Route::resource('/konten/galeri', AdminGaleriController::class);

    // Laporan
    Route::get('/laporan', [AdminLaporanController::class, 'index']);
    Route::post('/laporan', [AdminLaporanController::class, 'store']);
    Route::get('/laporan/pdf', [AdminLaporanController::class, 'exportPdf']);
});
