<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-gray-100">

    <div class="min-h-screen lg:flex" x-data="{ mobileOpen: false }">

        @include('layouts.navigation')

        <div x-show="mobileOpen" x-transition:enter="transition opacity-ease-out duration-300"
            x-transition:leave="transition opacity-ease-in duration-200" @click="mobileOpen = false"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

        <div class="flex-1 flex flex-col min-w-0">

            <div
                class="lg:hidden flex items-center justify-between bg-white dark:bg-gray-800 px-4 py-3 shadow-sm border-b dark:border-gray-700">
                <span class="font-bold text-blue-600">Tabungan Siswa</span>
                <button @click="mobileOpen = !mobileOpen"
                    class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            @isset($header)
                <header class="bg-transparent">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-12">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
