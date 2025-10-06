<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Transaksi;

class HistoriController extends Controller
{
    /**
     * Menampilkan semua histori transaksi semua siswa (dengan pencarian).
     */
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->has('q') && $request->q != '') {
            $query->where('nama', 'ilike', '%' . $request->q . '%')
                ->orWhere('nis', 'like', '%' . $request->q . '%');
        }

        $siswas = $query->paginate(10);

        return view('histori.index', compact('siswas'));
    }


    /**
     * Menampilkan semua histori transaksi untuk 1 siswa.
     */
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        $transaksis = Transaksi::where('siswa_id', $id)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        $totalSaldo = Transaksi::where('siswa_id', $id)
            ->selectRaw("SUM(CASE WHEN jenis = 'setoran' THEN nominal ELSE -nominal END) as saldo")
            ->value('saldo');

        return view('histori.show', compact('siswa', 'transaksis', 'totalSaldo'));
    }


    /**
     * Menghapus transaksi.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus');
    }
}
