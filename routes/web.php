<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TranksaksiController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TabunganSiswa;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/* Profile */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Admin */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('siswa', SiswaController::class);
    Route::resource('transaksi', TranksaksiController::class);
    Route::resource('laporan', LaporanController::class);
});

/* Admin & Siswa */
Route::middleware(['auth', 'role:admin|siswa'])->group(function () {
    Route::resource('tabungan', TabunganSiswa::class)->only(['index']);
    Route::resource('histori', HistoriController::class)->only(['index', 'show']);
});

require __DIR__ . '/auth.php';
