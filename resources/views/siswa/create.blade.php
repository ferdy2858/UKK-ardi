@extends('layout.app')

@section('title', 'Tambah Siswa')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6"> <h2 class="text-2xl font-semibold mb-4 text-center">Tambah Siswa</h2>
{{-- Tampilkan error validasi --}}
@if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('siswa.store') }}" method="POST" class="space-y-5">
    @csrf

    <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
            class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
    </div>

    <div>
        <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
        <input type="text" name="nis" id="nis" value="{{ old('nis') }}" required
            class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
    </div>

    <div>
        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
        <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" required
            class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
    </div>

    <div class="flex justify-end space-x-2">
        <a href="{{ route('siswa.index') }}"
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md text-sm">
            Batal
        </a>
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md text-sm">
            Simpan
        </button>
    </div>
</form>
</div> 
@endsection