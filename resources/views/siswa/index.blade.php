@extends('layout.app')

@section('title', 'Data Siswa')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Daftar Siswa</h2>
        <a href="{{ route('siswa.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Siswa
        </a>
    </div>

    <table class="w-full table-auto border border-gray-200 rounded overflow-hidden">
        <thead class="bg-gray-100">
            <tr class="text-left text-sm text-gray-600">
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">NIS</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Kelas</th>
                <th class="px-4 py-2 border">Saldo</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse ($siswas as $index => $siswa)
            <tr class="border-b">
                <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                <td class="px-4 py-2 border">{{ $siswa->nis }}</td>
                <td class="px-4 py-2 border">{{ $siswa->nama }}</td>
                <td class="px-4 py-2 border">{{ $siswa->kelas }}</td>
                <td class="px-4 py-2 border">Rp {{ number_format($siswa->saldo, 0, ',', '.') }}</td>
                <td class="px-4 py-2 border space-x-2">
                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus siswa ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">Data siswa belum tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
