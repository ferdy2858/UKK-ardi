<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Siswa --}}
                    <div class="mb-4">
                        <label for="siswa_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama Siswa</label>
                        <select name="siswa_id" id="siswa_id" required
                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ $transaksi->siswa_id == $siswa->id ? 'selected' : '' }}>
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
                        <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Jenis Transaksi</label>
                        <select name="jenis" id="jenis" required
                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            <option value="setoran" {{ $transaksi->jenis === 'setoran' ? 'selected' : '' }}>Setoran</option>
                            <option value="penarikan" {{ $transaksi->jenis === 'penarikan' ? 'selected' : '' }}>Penarikan</option>
                        </select>
                        @error('jenis')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nominal --}}
                    <div class="mb-4">
                        <label for="nominal" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nominal</label>
                        <input type="number" name="nominal" id="nominal" min="1" required
                               class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                               value="{{ old('nominal', $transaksi->nominal) }}">
                        @error('nominal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" required
                               class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                               value="{{ old('tanggal', $transaksi->tanggal) }}">
                        @error('tanggal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                            Update Transaksi
                        </button>
                        <a href="{{ route('transaksi.index') }}" class="ml-2 text-sm text-gray-600 dark:text-gray-300 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>