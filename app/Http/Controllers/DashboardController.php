<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalTransaksi = Transaksi::count();
        $totalSaldo =
            Transaksi::where('jenis', 'setoran')->sum('nominal')
            - Transaksi::where('jenis', 'penarikan')->sum('nominal');


        $transaksiTerbaru = Transaksi::with('siswa')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalSiswa',
            'totalTransaksi',
            'totalSaldo',
            'transaksiTerbaru'
        ));
    }
}
