<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120"
                            class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200">
                        </svg>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">



                    {{-- ADMIN ONLY --}}
                    @role('admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('siswa.index')" :active="request()->routeIs('siswa.*')">
                            Siswa
                        </x-nav-link>

                        <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">
                            Transaksi
                        </x-nav-link>

                        <x-nav-link :href="route('histori.index')" :active="request()->routeIs('histori.*')">
                            Histori
                        </x-nav-link>

                        <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">
                            Laporan
                        </x-nav-link>
                    @endrole

                    {{-- ADMIN & SISWA --}}
                    @hasanyrole('siswa')
                        <x-nav-link :href="route('tabungan.index')" :active="request()->routeIs('tabungan.*')">
                            Tabungan Siswa
                        </x-nav-link>
                    @endhasanyrole
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700">
                            <div>{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @role('admin')
                <x-responsive-nav-link :href="route('siswa.index')">Siswa</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transaksi.index')">Transaksi</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('laporan.index')">Laporan</x-responsive-nav-link>
            @endrole

            @hasanyrole('admin|siswa')
                <x-responsive-nav-link :href="route('histori.index')">Histori</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tabungan.index')">Tabungan Siswa</x-responsive-nav-link>
            @endhasanyrole
        </div>
    </div>
</nav>
