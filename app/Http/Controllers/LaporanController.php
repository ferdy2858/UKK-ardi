<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari   = $request->dari;
        $sampai = $request->sampai;

        // 🔹 Base query transaksi biar filter konsisten
        $baseTransaksi = Transaksi::query()
            ->when($dari && $sampai, fn($q) => $q->whereBetween('tanggal', [$dari, $sampai]))
            ->when($dari && !$sampai, fn($q) => $q->whereDate('tanggal', $dari));

        // 🔹 Summary
        $totalSaldo = Siswa::sum('saldo');

        $totalSetoran = (clone $baseTransaksi)
            ->where('jenis', 'setoran')
            ->sum('nominal');

        $totalPenarikan = (clone $baseTransaksi)
            ->where('jenis', 'penarikan')
            ->sum('nominal');

        $jumlahSiswa = Siswa::count();

        // 🔹 Grafik Bulanan
        $dataBulanan = (clone $baseTransaksi)
            ->select(
                DB::raw('EXTRACT(MONTH FROM tanggal) as bulan'),
                DB::raw("SUM(CASE WHEN jenis='setoran' THEN nominal ELSE 0 END) as total_setoran"),
                DB::raw("SUM(CASE WHEN jenis='penarikan' THEN nominal ELSE 0 END) as total_penarikan")
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // 🔹 Laporan per siswa (ikut filter tanggal)
        $filterSQL = '';
        if ($dari && $sampai) {
            $filterSQL = "AND tanggal BETWEEN '$dari' AND '$sampai'";
        } elseif ($dari) {
            $filterSQL = "AND DATE(tanggal) = '$dari'";
        }

        $laporanSiswa = Siswa::select(
            'nama',
            DB::raw("(SELECT COALESCE(SUM(nominal),0) FROM transaksis 
                      WHERE siswa_id = siswas.id AND jenis='setoran' $filterSQL) as total_setoran"),
            DB::raw("(SELECT COALESCE(SUM(nominal),0) FROM transaksis 
                      WHERE siswa_id = siswas.id AND jenis='penarikan' $filterSQL) as total_penarikan"),
            DB::raw("(
                (SELECT COALESCE(SUM(nominal),0) FROM transaksis 
                 WHERE siswa_id = siswas.id AND jenis='setoran' $filterSQL)
                -
                (SELECT COALESCE(SUM(nominal),0) FROM transaksis 
                 WHERE siswa_id = siswas.id AND jenis='penarikan' $filterSQL)
            ) as saldo_akhir")
        )
            ->orderByDesc('saldo_akhir')
            ->get();

        return view('laporan.index', compact(
            'totalSaldo',
            'totalSetoran',
            'totalPenarikan',
            'jumlahSiswa',
            'dataBulanan',
            'laporanSiswa',
            'dari',
            'sampai'
        ));
    }
}
