<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TranksaksiController;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('siswa', SiswaController::class);
    Route::resource('transaksi', TranksaksiController::class);
    Route::resource('histori', HistoriController::class);
    Route::resource('laporan', LaporanController::class);
});


require __DIR__ . '/auth.php';
