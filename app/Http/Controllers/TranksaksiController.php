<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TranksaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('siswa')->latest()->get();
        return view('transaksi.index', compact('transaksis'));
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
