<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tabungan Anda') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-6xl sm:px-6 lg:px-8">

            @forelse ($siswas as $siswa)

                <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 mb-6">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-blue-500 text-white flex items-center justify-center text-xl font-bold rounded-full">
                            {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $siswa->nama }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">NIS: {{ $siswa->nis }}</p>
                            <p class="text-gray-600 dark:text-gray-300">Kelas: {{ $siswa->kelas }}</p>
                        </div>

                        <div class="ml-auto text-right">
                            <p class="text-sm text-gray-500">Saldo</p>
                            <p class="text-xl font-bold text-green-500">
                                Rp {{ number_format($siswa->saldo, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Table Transaksi -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-10">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse text-center">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                                    <th class="px-4 py-3 border-b">No</th>
                                    <th class="px-4 py-3 border-b">Jenis</th>
                                    <th class="px-4 py-3 border-b">Nominal</th>
                                    <th class="px-4 py-3 border-b">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @forelse ($siswa->transaksis as $trx)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-100">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 capitalize">{{ $trx->jenis }}</td>
                                        <td class="px-4 py-3">
                                            Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-6 text-gray-500">
                                            Belum ada transaksi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            @empty
                <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6 text-center text-gray-500">
                    Belum ada data siswa.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
