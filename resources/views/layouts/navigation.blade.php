<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                        <span class="ml-2 text-xl font-bold text-gray-800">Perpustakaan</span>
                    </a>
                </div>
 
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                        {{ __('Buku') }}
                    </x-nav-link>
                    <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')">
                        {{ __('Anggota') }}
                    </x-nav-link>
                    <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">
                        {{ __('Transaksi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">
                        {{ __('Kategori') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- Search Box + Settings Dropdown (sejajar di kanan navbar) --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6 sm:gap-3">

                {{-- Global Search Box --}}
                <form action="{{ route('search') }}" method="GET" class="relative flex items-center">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="search" name="q" value="{{ request('q') }}"
                               placeholder="{{ __('Cari') }}..."
                               class="w-64 pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" />
                    </div>
                </form>

                {{-- Language Switcher & Dark Mode Toggle --}}
                <div class="flex items-center gap-2">
                    @if(app()->getLocale() == 'id')
                        <a href="{{ route('lang.switch', 'en') }}" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 font-bold text-xs" title="Switch to English">
                            EN
                        </a>
                    @else
                        <a href="{{ route('lang.switch', 'id') }}" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 font-bold text-xs" title="Ganti ke Bahasa Indonesia">
                            ID
                        </a>
                    @endif

                    <button id="darkModeToggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <i class="bi bi-moon-fill" id="moonIcon"></i>
                        <i class="bi bi-sun-fill" id="sunIcon" style="display: none;"></i>
                    </button>
                </div>

                {{-- Admin Dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
 
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
 
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
 
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
 
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
 
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                {{ __('Buku') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')">
                {{ __('Anggota') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">
                {{ __('Transaksi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.*')">
                {{ __('Kategori') }}
            </x-responsive-nav-link>

            {{-- Search Box (responsive/mobile) --}}
            <div class="px-4 pt-2">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="search" name="q" value="{{ request('q') }}"
                           placeholder="{{ __('Cari') }}..."
                           class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                </form>
            </div>
            
            {{-- Mobile Language Switcher & Dark Mode Toggle --}}
            <div class="px-4 pt-4 pb-2 flex gap-3">
                @if(app()->getLocale() == 'id')
                    <a href="{{ route('lang.switch', 'en') }}" class="btn btn-sm btn-outline-secondary flex-fill">English</a>
                @else
                    <a href="{{ route('lang.switch', 'id') }}" class="btn btn-sm btn-outline-secondary flex-fill">Indonesia</a>
                @endif
                <button id="darkModeToggleMobile" class="btn btn-sm btn-outline-secondary flex-fill">
                    <i class="bi bi-moon-fill" id="moonIconMobile"></i>
                    <i class="bi bi-sun-fill" id="sunIconMobile" style="display: none;"></i> Mode
                </button>
            </div>
        </div>
 
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
 
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
 
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
 
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('darkModeToggle');
    const toggleBtnMobile = document.getElementById('darkModeToggleMobile');
    const moonIcon = document.getElementById('moonIcon');
    const sunIcon = document.getElementById('sunIcon');
    const moonIconMobile = document.getElementById('moonIconMobile');
    const sunIconMobile = document.getElementById('sunIconMobile');
    
    // Function to update icon based on theme
    function updateIcon(theme) {
        if (theme === 'dark') {
            if(moonIcon) moonIcon.style.display = 'none';
            if(sunIcon) sunIcon.style.display = 'inline-block';
            if(moonIconMobile) moonIconMobile.style.display = 'none';
            if(sunIconMobile) sunIconMobile.style.display = 'inline-block';
        } else {
            if(moonIcon) moonIcon.style.display = 'inline-block';
            if(sunIcon) sunIcon.style.display = 'none';
            if(moonIconMobile) moonIconMobile.style.display = 'inline-block';
            if(sunIconMobile) sunIconMobile.style.display = 'none';
        }
    }
    
    // Initialize icon
    const currentTheme = localStorage.getItem('theme') || 'light';
    updateIcon(currentTheme);
    
    // Toggle function
    function toggleTheme() {
        const theme = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-bs-theme');
        }
        localStorage.setItem('theme', theme);
        updateIcon(theme);
    }
    
    if (toggleBtn) toggleBtn.addEventListener('click', toggleTheme);
    if (toggleBtnMobile) toggleBtnMobile.addEventListener('click', toggleTheme);
});
</script>
@endpush