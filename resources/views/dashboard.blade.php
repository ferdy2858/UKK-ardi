<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg rounded-2xl flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        📚
                    </div>
                    <div>
                        <p class="text-sm opacity-80">Total Siswa</p>
                        <p class="text-2xl font-bold">{{ $totalSiswa }}</p>
                    </div>
                </div>

                <div
                    class="p-6 bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg rounded-2xl flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        💰
                    </div>
                    <div>
                        <p class="text-sm opacity-80">Total Transaksi</p>
                        <p class="text-2xl font-bold">{{ $totalTransaksi }}</p>
                    </div>
                </div>

                <div
                    class="p-6 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-lg rounded-2xl flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        🏦
                    </div>
                    <div>
                        <p class="text-sm opacity-80">Total Saldo</p>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Transaksi Terbaru</h3>
                    <a href="{{ route('transaksi.index') }}" class="text-blue-500 hover:underline text-sm">Lihat
                        Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="p-3 text-gray-600 dark:text-gray-300">Siswa</th>
                                <th class="p-3 text-gray-600 dark:text-gray-300">Tanggal</th>
                                <th class="p-3 text-gray-600 dark:text-gray-300">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerbaru as $trx)
                                <tr
                                    class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="p-3 text-gray-800 dark:text-gray-200">{{ $trx->siswa->nama }}</td>
                                    <td class="p-3 text-gray-600 dark:text-gray-300">
                                        {{ $trx->created_at->format('d-m-Y') }}</td>
                                    <td
                                        class="p-3 font-semibold {{ $trx->jenis === 'penarikan' ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                                        @if ($trx->jenis === 'penarikan')
                                            🔻 Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                                        @else
                                            💰 Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-3 text-center text-gray-500 dark:text-gray-400">Tidak
                                        ada transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
