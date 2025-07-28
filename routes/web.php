<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TranksaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('siswa', SiswaController::class);
Route::resource('transaksi', TranksaksiController::class);