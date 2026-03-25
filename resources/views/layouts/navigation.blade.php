<aside :class="mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
       class="fixed inset-y-0 left-0 z-50 w-72 transition-transform duration-300 transform lg:static lg:inset-0 p-4 h-screen">
    
    <div class="h-full bg-white dark:bg-gray-800 shadow-xl rounded-[2rem] border border-gray-100 dark:border-gray-700 flex flex-col overflow-hidden">
        
        <div class="p-8 flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg shadow-blue-200 dark:shadow-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-xl font-extrabold tracking-tight text-gray-800 dark:text-white">Tabungan<span class="text-blue-600">Siswa</span></span>
        </div>

        <nav class="flex-1 px-6 space-y-2 overflow-y-auto">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4 ml-2">Menu Utama</p>

            @role('admin')
            <x-nav-item :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="Dashboard" />
            
            <x-nav-item :href="route('siswa.index')" :active="request()->routeIs('siswa.*')" icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" label="Data Siswa" />

            <x-nav-item :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')" icon="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" label="Transaksi" />

            <x-nav-item :href="route('laporan.index')" :active="request()->routeIs('laporan.*')" icon="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z" label="Laporan" />
            @endrole

            @hasanyrole('admin')
            <x-nav-item :href="route('histori.index')" :active="request()->routeIs('histori.*')" icon="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" label="Histori" />
            @endhasanyrole

            @role('siswa')
            <x-nav-item :href="route('tabungan.index')" :active="request()->routeIs('tabungan.*')" icon="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3z" label="Tabungan Saya" />
            @endrole
        </nav>

        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 m-6 rounded-[1.5rem] border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-10 w-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="truncate">
                    <p class="text-sm font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">{{ Auth::user()->roles->pluck('name')[0] ?? 'User' }}</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-center p-2 rounded-xl bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:text-blue-600 shadow-sm transition-all border border-transparent hover:border-blue-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center p-2 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 hover:bg-red-100 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>