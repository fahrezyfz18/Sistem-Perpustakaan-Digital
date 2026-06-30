<nav class="bg-white border-b border-gray-200/80 shadow-sm sticky top-0 z-20 w-full px-4 sm:px-6">
    <div class="flex justify-between h-16 items-center">

        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="block md:hidden text-kombu hover:text-asparagus p-2 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-asparagus/20"
                    aria-label="Toggle Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="sidebarOpen ? 'hidden' : 'inline-flex'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="sidebarOpen ? 'inline-flex' : 'hidden'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <a href="{{ url('/') }}" class="flex items-center gap-2 focus:outline-none">
                <span class="text-kombu font-bold text-xl tracking-tight hover:text-asparagus transition-colors">
                    {{ config('app.name', 'LeafShelf') }}
                </span>
            </a>
        </div>

        <div class="flex items-center gap-3">
            <button type="button"
                class="relative text-kombu/80 hover:text-asparagus p-2 rounded-xl transition-colors focus:outline-none hover:bg-gray-50">
                <span class="sr-only">Lihat Notifikasi</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>

            <div class="flex items-center" x-data="{ profileOpen: false }" @click.away="profileOpen = false">
                <div class="relative">
                    <button @click="profileOpen = !profileOpen"
                        class="flex items-center gap-2 text-sm font-semibold text-kombu hover:text-asparagus transition-colors p-1.5 rounded-xl hover:bg-gray-50 focus:outline-none">
                        <div class="w-8 h-8 bg-kombu text-white text-xs font-bold rounded-full flex items-center justify-center shadow-inner uppercase">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:inline-block max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-kombu/60 transition-transform duration-200" :class="profileOpen ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="profileOpen"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 border border-gray-100 z-50 focus:outline-none"
                         x-cloak>
                        
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.profile.index') : route('user.profile.show') }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-olivine/10 hover:text-kombu transition-colors font-medium">
                            Profil Saya
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <button type="button" @click="profileOpen = false; logoutModalOpen = true"
                                class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium transition-colors">
                            Keluar (Logout)
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>