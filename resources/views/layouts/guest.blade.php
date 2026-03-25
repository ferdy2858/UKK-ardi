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

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50 dark:bg-gray-950 relative overflow-hidden">

        <div
            class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-0 -right-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
        </div>

        <div class="z-10 transition-transform hover:scale-110 duration-300">
            <a href="/" class="flex flex-col items-center">
                <div
                    class="p-4 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl shadow-2xl shadow-blue-200 dark:shadow-none mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-12 h-12 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147L12 15l7.74-4.853a4.5 4.5 0 00-4.897-7.37L12 5.25l-2.843-2.473a4.5 4.5 0 00-4.897 7.37z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 10.5v5.379c0 1.24-.57 2.415-1.541 3.185l-5.25 4.156a4.5 4.5 0 01-5.418 0l-5.25-4.156A4.147 4.147 0 013 15.879V10.5" />
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-800 dark:text-white">
                    Tabungan<span class="text-blue-600">Siswa</span>
                </h1>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-8 px-8 py-10 bg-white/80 dark:bg-gray-800/90 backdrop-blur-xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.1)] dark:shadow-none overflow-hidden sm:rounded-[2.5rem] border border-white dark:border-gray-700 z-10">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center z-10">
            <p class="text-sm text-gray-400 font-medium tracking-wide">
                &copy; {{ date('Y') }} — Kelola Tabungan Lebih Mudah
            </p>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>

</html>
