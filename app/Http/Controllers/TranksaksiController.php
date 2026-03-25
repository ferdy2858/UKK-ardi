<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TranksaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $jenis  = $request->jenis;
        $dari   = $request->dari;
        $sampai = $request->sampai;

        $transaksis = Transaksi::query()
            ->select('transaksis.*')
            ->join('siswas', 'siswas.id', '=', 'transaksis.siswa_id')

            // 🔍 SEARCH NAMA / NIS
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('siswas.nama', 'ilike', "%$search%")
                        ->orWhere('siswas.nis', 'like', "%$search%");
                });
            })

            // 🏷️ FILTER JENIS
            ->when($jenis, fn($q) => $q->where('transaksis.jenis', $jenis))

            // 📅 FILTER TANGGAL
            ->when($dari && $sampai, fn($q) => $q->whereBetween('transaksis.tanggal', [$dari, $sampai]))
            ->when($dari && !$sampai, fn($q) => $q->whereDate('transaksis.tanggal', $dari))

            ->with('siswa') // biar relasi tetap bisa dipakai di blade
            ->latest('transaksis.created_at')
            ->paginate(10)
            ->withQueryString();

        return view('transaksi.index', compact(
            'transaksis',
            'search',
            'jenis',
            'dari',
            'sampai'
        ));
    }

    public function create()
    {
        $siswas = Siswa::all();
        return view('transaksi.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis' => 'required|in:setoran,penarikan',
            'nominal' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        if ($request->jenis === 'penarikan' && $request->nominal > $siswa->saldo) {
            return back()->with('error', 'Saldo tidak mencukupi untuk penarikan.');
        }

        // Update saldo siswa
        if ($request->jenis === 'setoran') {
            $siswa->saldo += $request->nominal;
        } else {
            $siswa->saldo -= $request->nominal;
        }
        $siswa->save();

        // Simpan transaksi
        Transaksi::create($request->only('siswa_id', 'jenis', 'nominal', 'tanggal'));

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $siswas = Siswa::all();
        return view('transaksi.edit', compact('transaksi', 'siswas'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'siswa_id' => 'required|exists:siswas,id',
    //         'jenis' => 'required|in:setoran,penarikan',
    //         'nominal' => 'required|integer|min:1',
    //         'tanggal' => 'required|date',
    //     ]);

    //     $transaksi = Transaksi::findOrFail($id);
    //     $siswa = Siswa::findOrFail($transaksi->siswa_id);

    //     // Revert saldo lama
    //     if ($transaksi->jenis === 'setoran') {
    //         $siswa->saldo -= $transaksi->nominal;
    //     } else {
    //         $siswa->saldo += $transaksi->nominal;
    //     }

    //     // Cek jika saldo cukup untuk penarikan baru
    //     if ($request->jenis === 'penarikan' && $request->nominal > $siswa->saldo) {
    //         return back()->with('error', 'Saldo tidak mencukupi untuk penarikan.');
    //     }

    //     // Apply saldo baru
    //     if ($request->jenis === 'setoran') {
    //         $siswa->saldo += $request->nominal;
    //     } else {
    //         $siswa->saldo -= $request->nominal;
    //     }

    //     $siswa->save();

    //     $transaksi->update($request->only('siswa_id', 'jenis', 'nominal', 'tanggal'));

    //     return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    // }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $siswa = $transaksi->siswa;

        // Revert saldo saat hapus
        if ($transaksi->jenis === 'setoran') {
            $siswa->saldo -= $transaksi->nominal;
        } else {
            $siswa->saldo += $transaksi->nominal;
        }

        $siswa->save();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
