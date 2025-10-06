<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Laporan Tabungan Siswa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-600 text-white p-4 rounded-lg shadow text-center">
                    <p>Total Saldo</p>
                    <h3 class="text-2xl font-bold">Rp {{ number_format($totalSaldo,0,',','.') }}</h3>
                </div>
                <div class="bg-green-600 text-white p-4 rounded-lg shadow text-center">
                    <p>Setoran Bulan Ini</p>
                    <h3 class="text-2xl font-bold">Rp {{ number_format($totalSetoranBulanIni,0,',','.') }}</h3>
                </div>
                <div class="bg-red-600 text-white p-4 rounded-lg shadow text-center">
                    <p>Penarikan Bulan Ini</p>
                    <h3 class="text-2xl font-bold">Rp {{ number_format($totalPenarikanBulanIni,0,',','.') }}</h3>
                </div>
                <div class="bg-yellow-500 text-white p-4 rounded-lg shadow text-center">
                    <p>Jumlah Siswa</p>
                    <h3 class="text-2xl font-bold">{{ $jumlahSiswa }}</h3>
                </div>
            </div>

            <!-- Grafik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <canvas id="grafikBulanan" style="height:300px;"></canvas>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex justify-center items-center">
                    <div style="width:300px; height:300px;">
                        <canvas id="grafikPie"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow overflow-x-auto">
                <h3 class="text-lg font-bold mb-4 text-gray-200">Detail Laporan</h3>
                <table class="min-w-full text-sm text-gray-200 border border-gray-700">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-4 py-2">Nama Siswa</th>
                            <th class="px-4 py-2">Total Setoran</th>
                            <th class="px-4 py-2">Total Penarikan</th>
                            <th class="px-4 py-2">Saldo Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-black dark:text-gray-300">
                        @foreach($laporanSiswa as $row)
                        <tr class="border-b border-gray-600">
                            <td class="px-4 py-2">{{ $row->nama }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($row->total_setoran,0,',','.') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($row->total_penarikan,0,',','.') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($row->saldo_akhir,0,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar chart
        const ctxBar = document.getElementById('grafikBulanan');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: {!! json_encode($dataBulanan->pluck('bulan')) !!},
                datasets: [
                    {
                        label: 'Setoran',
                        data: {!! json_encode($dataBulanan->pluck('total_setoran')) !!},
                        backgroundColor: 'rgba(34, 197, 94, 0.7)'
                    },
                    {
                        label: 'Penarikan',
                        data: {!! json_encode($dataBulanan->pluck('total_penarikan')) !!},
                        backgroundColor: 'rgba(239, 68, 68, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Pie chart
        const ctxPie = document.getElementById('grafikPie');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Setoran', 'Penarikan'],
                datasets: [{
                    data: [
                        {{ $totalSetoranBulanIni }},
                        {{ $totalPenarikanBulanIni }}
                    ],
                    backgroundColor: ['#22c55e', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
