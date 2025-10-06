<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('History Transaksi - Daftar Siswa') }}
            </h2>

            <!-- Search -->
            <div class="flex items-center gap-2">
                <form action="{{ route('histori.index') }}" method="GET" class="flex">
                    <input type="text" id="searchInput" name="q" value="{{ request('q') }}"
                        placeholder="Cari nama atau NIS..."
                        class="rounded-l-md border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md text-sm transition">
                        Cari
                    </button>
                </form>
            </div>
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
                                <th class="px-4 py-3 border-b">Nama Siswa</th>
                                <th class="px-4 py-3 border-b">NIS</th>
                                <th class="px-4 py-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($siswas as $siswa)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-100">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $siswa->nama }}</td>
                                    <td class="px-4 py-3">{{ $siswa->nis }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('histori.show', $siswa->id) }}"
                                            class="px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded">
                                            Lihat Transaksi
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500">
                                        Belum ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $siswas->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>