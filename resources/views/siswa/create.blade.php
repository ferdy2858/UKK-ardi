<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Flash Message -->
                @if (session('success'))
                    <div class="mb-4 text-green-600 dark:text-green-400">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('siswa.store') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Nama
                        </label>
                        <input type="text" name="nama" id="nama"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white"
                            value="{{ old('nama') }}" required>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIS -->
                    <div class="mb-4">
                        <label for="nis" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            NIS
                        </label>
                        <input type="text" name="nis" id="nis"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white"
                            value="{{ old('nis') }}" required>
                        @error('nis')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div class="mb-4">
                        <label for="kelas" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Kelas
                        </label>
                        <input type="text" name="kelas" id="kelas"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white"
                            value="{{ old('kelas') }}" required>
                        @error('kelas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            Password Akun Login
                        </label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white"
                            required>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Gunakan password minimal 4 karakter.
                        </p>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('siswa.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded-md text-sm font-medium hover:bg-gray-400 dark:hover:bg-gray-500 mr-2">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-white text-sm hover:bg-indigo-700 dark:hover:bg-indigo-600">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
