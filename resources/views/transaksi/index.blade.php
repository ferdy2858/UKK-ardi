<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <!-- Judul -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Data Transaksi') }}
            </h2>

            <!-- Filter + Tombol -->
            <div class="flex items-center gap-2 flex-wrap">

                <form action="{{ route('transaksi.index') }}" method="GET" class="flex flex-wrap items-center gap-2">

                    <!-- 🔍 Search -->
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa..."
                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 rounded text-sm
                               dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <!-- 🏷️ Filter Jenis -->
                    <select name="jenis"
                        class="border border-gray-300 dark:border-gray-600 px-3 py-2 rounded text-sm
                               dark:bg-gray-900 dark:text-white">
                        <option value="">Semua Jenis</option>
                        <option value="setoran" {{ request('jenis') == 'setoran' ? 'selected' : '' }}>Setoran</option>
                        <option value="penarikan" {{ request('jenis') == 'penarikan' ? 'selected' : '' }}>Penarikan</option>
                    </select>

                    <!-- 📅 Dari -->
                    <input type="date" name="dari" value="{{ request('dari') }}"
                        class="border border-gray-300 dark:border-gray-600 px-3 py-2 rounded text-sm
                               dark:bg-gray-900 dark:text-white">

                    <!-- 📅 Sampai -->
                    <input type="date" name="sampai" value="{{ request('sampai') }}"
                        class="border border-gray-300 dark:border-gray-600 px-3 py-2 rounded text-sm
                               dark:bg-gray-900 dark:text-white">

                    <!-- 🔎 Tombol Filter -->
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition">
                        Filter
                    </button>

                    <!-- 🔄 Reset -->
                    <a href="{{ route('transaksi.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm transition">
                        Reset
                    </a>

                </form>

                <!-- ➕ Tambah -->
                <a href="{{ route('transaksi.create') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition text-sm">
                    + Tambah Transaksi
                </a>

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
                                    <td class="px-4 py-2">
                                        {{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-2">{{ $transaksi->siswa->nama }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="{{ $transaksi->jenis === 'setoran' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ ucfirst($transaksi->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        Rp{{ number_format($transaksi->nominal, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ date('d-m-Y', strtotime($transaksi->tanggal)) }}
                                    </td>
                                    <td class="px-4 py-2 space-x-2">
                                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-gray-500">
                                        Belum ada data transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $transaksis->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert konfirmasi hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin?',
                    text: "Data transaksi ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Toast notifikasi
        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        @endif
    </script>
</x-app-layout>
