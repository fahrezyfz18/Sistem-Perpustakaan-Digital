<nav x-data="{
    sidebarOpen: false,
    profileOpen: false
}"
 class="bg-white border-b border-kombu/20 shadow-sm sticky top-0 z-50">

    <div class="w-full px-4 sm:px-6">
        <div class="flex justify-between h-16 items-center">

            <div class="flex items-center gap-4">
                
            <button @click="sidebarOpen = !sidebarOpen"
                    class="block md:hidden text-kombu hover:text-asparagus p-2 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-asparagus/30"
                    aria-label="Toggle Navigation Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{' 'hidden': sidebarOpen, 'inline-flex': !sidebarOpen }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !profileOpen, 'inline-flex': profileOpen }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <a href="{{ url('/') }}" class="flex items-center gap-2 focus:outline-none">
                    <span class="text-kombu font-bold text-xl tracking-tight hover:text-asparagus transition-colors">
                        {{ config('app.name', 'LeafShelf') }}
                    </span>
                </a>
            </div>

            <div class="flex items-center gap-4">

                <button type="button"
                    class="relative text-kombu hover:text-asparagus p-2 rounded-full transition-colors focus:outline-none">
                    <span class="sr-only">Lihat Notifikasi</span>
                    <i class="fas fa-bell text-lg"></i>
                </button>

                <div class="hidden md:flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 text-sm font-semibold text-kombu hover:text-asparagus transition-colors p-1.5 rounded-lg focus:outline-none">
                                <div
                                    class="w-8 h-8 bg-kombu text-white text-xs font-bold rounded-full flex items-center justify-center shadow-sm uppercase">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span
                                    class="hidden sm:inline-block max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-kombu/60" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="auth()->user()->role === 'admin' ? route('admin.profile.index') : route('user.profile.show')"
                                class="text-kombu hover:text-mustard hover:bg-olivine/10 font-medium transition-colors">
                                <i class="fas fa-user-circle mr-2 opacity-70"></i> Profile
                            </x-dropdown-link>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar dari LeafShelf?')) { this.closest('form').submit(); }"
                                    class="text-red-600 hover:bg-red-50 font-medium transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2 opacity-70"></i> Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden md:hidden border-t border-gray-100 bg-gray-50/50 backdrop-blur-md">

        <div class="flex items-center gap-3 px-4 py-3 border-b border-gray-100">
            <div
                class="w-9 h-9 bg-kombu text-white text-sm font-bold rounded-full flex items-center justify-center shadow-sm uppercase">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-bold text-kombu truncate">{{ Auth::user()->name }}</span>
                <span class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</span>
            </div>
        </div>

        <div class="px-2 py-2 space-y-1">
            <x-responsive-nav-link :href="auth()->user()->role === 'admin' ? route('admin.profile.edit') : route('user.profile.edit')"
                class="block px-3 py-2 rounded-lg text-base font-medium text-kombu hover:bg-olivine/10 transition-colors">
                <i class="fas fa-edit mr-2 opacity-70"></i> Edit Profile
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar dari LeafShelf?')) { this.closest('form').submit(); }"
                    class="block px-3 py-2 rounded-lg text-base font-medium text-red-600 hover:bg-red-50 transition-colors">
                    <i class="fas fa-sign-out-alt mr-2 opacity-70"></i> Log Out
                </x-responsive-nav-link>
            </form>
        </div>
    </div>

</nav>
