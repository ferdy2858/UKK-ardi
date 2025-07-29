<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Data Transaksi') }}
            </h2>
            <a href="{{ route('transaksi.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
                + Tambah Transaksi
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
                                <th class="px-4 py-3 border-b">Jenis</th>
                                <th class="px-4 py-3 border-b">Nominal</th>
                                <th class="px-4 py-3 border-b">Tanggal</th>
                                <th class="px-4 py-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-800 dark:text-gray-100">
                            @forelse($transaksis as $transaksi)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $transaksi->siswa->nama }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="{{ $transaksi->jenis === 'setoran' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ ucfirst($transaksi->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">Rp{{ number_format($transaksi->nominal, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2">{{ date('d-m-Y', strtotime($transaksi->tanggal)) }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        {{-- <a href="{{ route('transaksi.edit', $transaksi->id) }}"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a> --}}
                                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-gray-500">Belum ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
