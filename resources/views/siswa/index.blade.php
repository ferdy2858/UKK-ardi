<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Data Siswa') }}
            </h2>
            <a href="{{ route('siswa.create') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                + Tambah Siswa
            </a>
        </div>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-6xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse text-center">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                                <th class="px-4 py-3 border-b">No</th>
                                <th class="px-4 py-3 border-b">Nama</th>
                                <th class="px-4 py-3 border-b">NIS</th>
                                <th class="px-4 py-3 border-b">Kelas</th>
                                <th class="px-4 py-3 border-b">Saldo</th>
                                <th class="px-4 py-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($siswas as $siswa)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-100">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $siswa->nama }}</td>
                                    <td class="px-4 py-3">{{ $siswa->nis }}</td>
                                    <td class="px-4 py-3">{{ $siswa->kelas }}</td>
                                    <td class="px-4 py-3">Rp{{ number_format($siswa->saldo, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 space-x-2">
                                        <a href="{{ route('siswa.edit', $siswa->id) }}"
                                            class="inline-block px-3 py-1 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus siswa ini?')"
                                                class="px-3 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500">Belum ada data siswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
