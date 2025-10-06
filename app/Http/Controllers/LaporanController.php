<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Transaksi;
use Carbon\Carbon;
use DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSaldo = Siswa::sum('saldo');
        $totalSetoranBulanIni = Transaksi::where('jenis', 'setoran')
            ->whereMonth('tanggal', Carbon::now()->month)
            ->sum('nominal');
        $totalPenarikanBulanIni = Transaksi::where('jenis', 'penarikan')
            ->whereMonth('tanggal', Carbon::now()->month)
            ->sum('nominal');
        $jumlahSiswa = Siswa::count();

        // Data grafik bulanan
        $dataBulanan = Transaksi::select(
            DB::raw('EXTRACT(MONTH FROM tanggal) as bulan'),
            DB::raw("SUM(CASE WHEN jenis = 'setoran' THEN nominal ELSE 0 END) as total_setoran"),
            DB::raw("SUM(CASE WHEN jenis = 'penarikan' THEN nominal ELSE 0 END) as total_penarikan")
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Data tabel detail per siswa
        $laporanSiswa = Siswa::select(
            'nama',
            DB::raw("(SELECT COALESCE(SUM(nominal),0) FROM transaksis WHERE siswa_id = siswas.id AND jenis='setoran') as total_setoran"),
            DB::raw("(SELECT COALESCE(SUM(nominal),0) FROM transaksis WHERE siswa_id = siswas.id AND jenis='penarikan') as total_penarikan"),
            DB::raw("(
            (SELECT COALESCE(SUM(nominal),0) FROM transaksis WHERE siswa_id = siswas.id AND jenis='setoran')
            - 
            (SELECT COALESCE(SUM(nominal),0) FROM transaksis WHERE siswa_id = siswas.id AND jenis='penarikan')
        ) as saldo_akhir")
        )
            ->orderByDesc('saldo_akhir')
            ->get();


        return view('laporan.index', compact(
            'totalSaldo',
            'totalSetoranBulanIni',
            'totalPenarikanBulanIni',
            'jumlahSiswa',
            'dataBulanan',
            'laporanSiswa'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
