<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;



Route::get('/',[UserController::class, 'home'])->name('guest.home');
Route::get('/login',[AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ----------------------------
// Rute untuk Pengelola (Admin)
// ----------------------------
Route::middleware(['auth', 'role:pengelola'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/', [UserController::class, 'admin'])->name('admin.home');
    Route::get('/home', [UserController::class, 'admin']);

    // Laporan
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('admin.laporan');

    // Notifikasi
    Route::prefix('notifikasi')->group(function () {
        Route::get('/', [NotifikasiController::class, 'index'])->name('admin.notifikasi');
        Route::get('/edit', [NotifikasiController::class, 'edit'])->name('notifikasi.edit');
        Route::post('/', [NotifikasiController::class, 'update'])->name('notifikasi.update');
    });

    // Status Laundry
    Route::prefix('status')->group(function () {
        Route::get('/', [LaundryController::class, 'updateStatus'])->name('admin.status');
        Route::put('/update/{id}', [LaundryController::class, 'edit'])->name('status.edit');
        Route::get('/delete/{id}', [LaundryController::class, 'destroy'])->name('status.destroy');
    });
});


// -------------------------
// Rute untuk Penghuni (User)
// -------------------------
Route::middleware(['auth', 'role:penghuni'])->group(function () {

    // Laundry (Titip)
    Route::prefix('titip')->group(function () {
        Route::get('/', [LaundryController::class, 'index'])->name('laundry.dashboard');
        Route::post('/', [LaundryController::class, 'store'])->name('laundry.store');
    });

    // Status Laundry Pengguna
    Route::get('/status', [LaundryController::class, 'showStatus'])->name('laundry.status');

    // Transaksi Pengguna
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('user.transaksi');
        Route::post('/{id}/bayar', [TransaksiController::class, 'bayar'])->name('user.bayar');
    });
});


