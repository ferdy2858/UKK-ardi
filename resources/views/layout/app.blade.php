<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabungan Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow min-h-screen p-4">
            <h2 class="text-2xl font-bold mb-6">Tabungan Siswa</h2>
            <nav class="space-y-2">
                <a href="{{ route('siswa.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>
                {{-- <a href="{{ route('siswa.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Data Siswa</a>
                <a href="{{ route('transaksi.setoran') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Setoran</a>
                <a href="{{ route('transaksi.penarikan') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Penarikan</a>
                <a href="{{ route('laporan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Laporan</a> --}}
                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-700">Logout</button>
                </form> --}}
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-semibold mb-4">@yield('title', 'Dashboard')</h1>
            @yield('content')
        </main>
    </div>
</body>
</html>