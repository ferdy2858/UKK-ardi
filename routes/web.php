<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('siswa', SiswaController::class);