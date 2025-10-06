<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->filled('q')) {
            $query->where('nama', 'ILIKE', "%{$request->q}%")
                ->orWhere('nis', 'ILIKE', "%{$request->q}%");
        }

        $siswas = $query->paginate(10)->appends($request->query()); // ✅ ini yang benar

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|unique:siswas',
            'kelas' => 'required|string',
            'email' => 'required|email|unique:users,email', // ✅ tambahkan ini
            'password' => 'required|min:4',
        ]);

        // 1️⃣ Buat akun user dengan email dari input
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email, // ✅ ambil dari form
            'password' => Hash::make($request->password),
        ]);

        // 2️⃣ Buat data siswa
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'saldo' => 0,
            'user_id' => $user->id,
        ]);

        // 3️⃣ Berikan role "siswa"
        $user->assignRole('siswa');

        return redirect()->route('siswa.index')->with('success', 'Data siswa dan akun login berhasil dibuat.');
    }




    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required|string',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
