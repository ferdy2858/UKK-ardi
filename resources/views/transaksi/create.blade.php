<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <style>
        /* Perbaikan kecil agar serasi dengan Dark Mode Tailwind */
        .ts-control {
            border-radius: 0.375rem !important;
        }

        .dark .ts-control,
        .dark .ts-dropdown {
            background-color: #111827 !important;
            color: white !important;
            border-color: #374151 !important;
        }

        .dark .ts-dropdown .active {
            background-color: #1f2937 !important;
            color: white !important;
        }

        .dark .ts-dropdown .option {
            color: #d1d5db !important;
        }
    </style>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf

                    {{-- Siswa dengan Fitur Search --}}
                    <div class="mb-4">
                        <label for="siswa_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama Siswa</label>
                        <select name="siswa_id" id="siswa_id" required placeholder="Ketik nama atau NIS siswa..."
                            autocomplete="off"
                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}"
                                    {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama }} ({{ $siswa->nis }})
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis --}}
                    <div class="mb-4">
                        <label for="jenis"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Jenis
                            Transaksi</label>
                        <select name="jenis" id="jenis" required
                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="setoran" {{ old('jenis') == 'setoran' ? 'selected' : '' }}>Setoran</option>
                            <option value="penarikan" {{ old('jenis') == 'penarikan' ? 'selected' : '' }}>Penarikan
                            </option>
                        </select>
                        @error('jenis')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nominal --}}
                    <div class="mb-4">
                        <label for="nominal"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nominal</label>
                        <input type="number" name="nominal" id="nominal" min="1" required
                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                            value="{{ old('nominal') }}">
                        @error('nominal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <label for="tanggal"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" required
                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                            value="{{ old('tanggal') ?? date('Y-m-d') }}">
                        @error('tanggal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                            Simpan Transaksi
                        </button>
                        <a href="{{ route('transaksi.index') }}"
                            class="ml-2 text-sm text-gray-600 dark:text-gray-300 hover:underline">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#siswa_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
</x-app-layout>
