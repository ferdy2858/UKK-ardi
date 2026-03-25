<!-- resources/views/histori/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail History Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-5xl sm:px-6 lg:px-8">
            <!-- Kartu Profil Siswa -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 mb-6">
                <div class="flex items-center gap-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white"></h3>
                        <p class="text-gray-600 dark:text-gray-300">NIS:</p>
                        <p class="text-gray-600 dark:text-gray-300">Kelas:</p>
                    </div>
                    <div class="ml-auto">
                        <p class="text-gray-500 dark:text-gray-300 text-sm">Total Saldo</p>
                        <p class="text-2xl font-bold text-green-500">
                            
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tabel Transaksi -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Riwayat Transaksi
                </h4>

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
                            
                    </table>
                </div>

                <div class="mt-4">
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-4">
                <a href=""
                    class="inline-block px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
