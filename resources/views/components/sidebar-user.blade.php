<aside
    class="fixed inset-y-0 left-0 z-40 w-64 h-screen bg-primary text-white shadow-2xl font-sans transition-transform duration-300 ease-in-out transform"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

    <div class="flex items-center justify-center h-16 px-6 border-b border-white/10">
        <a href="{{ route('user.dashboard') }}" class="flex items-center justify-center h-full">
            <img src="{{ asset('images/LOGO_LS_TRANSPARAN.png') }}" alt="LeafShelf Logo"
                class="h-10 w-auto object-contain brightness-110 contrast-105 transition duration-300 hover:scale-105" />
        </a>
    </div>

    <nav class="p-4 space-y-1.5 overflow-y-auto h-[calc(100%-4rem)] flex flex-col justify-between">
        <div class="space-y-1.5">
            <a href="{{ route('user.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.dashboard') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2 7-7 7 7 2 2M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('user.books.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.books.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5 4.462 5 2 6.567 2 8.5v10C2 16.567 4.462 15 7.5 15c1.746 0 3.332.483 4.5 1.253m0-13C13.168 5.483 14.754 5 16.5 5c3.038 0 5.5 1.567 5.5 3.5v10c0-1.933-2.462-3.5-5.5-3.5-1.746 0-3.332.483-4.5 1.253" />
                </svg>
                <span>Daftar Buku</span>
            </a>

            <a href="{{ route('user.my-books.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.my-books.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4v16l7-5 7 5V4z" />
                </svg>
                <span>Buku Saya</span>
            </a>

            <a href="{{ route('user.profile.show') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.profile.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Pengaturan Profil</span>
            </a>
        </div>

        <div class="pt-4 border-t border-white/10">
            <button type="button" @click="logoutModalOpen = true"
                class="flex items-center w-full gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 bg-secondary text-white hover:bg-camel font-medium shadow-md shadow-secondary/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                <span>Logout</span>
            </button>
        </div>
    </nav>
</aside>