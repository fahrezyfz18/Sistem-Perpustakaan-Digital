<aside
    class="fixed inset-y-0 left-0 z-40 w-64 h-screen bg-primary text-white shadow-2xl font-sans transition-transform duration-300 ease-in-out transform"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

    <div class="flex items-center justify-center h-16 px-6 border-b border-white/10">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center h-full">
            <img src="{{ asset('images/LOGO_LS_TRANSPARAN.png') }}" alt="LeafShelf Logo" 
                 class="h-10 w-auto object-contain brightness-110 contrast-105 transition duration-300 hover:scale-105" />
        </a>
    </div>

    <nav class="p-4 space-y-1.5 overflow-y-auto h-[calc(100%-4rem)] flex flex-col justify-between">
        <div class="space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2 7-7 7 7 2 2M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.buku.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.buku.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.483 9.246 5 7.5 5 4.462 5 2 6.567 2 8.5v10C2 16.567 4.462 15 7.5 15c1.746 0 3.332.483 4.5 1.253m0-13C13.168 5.483 14.754 5 16.5 5c3.038 0 5.5 1.567 5.5 3.5v10c0-1.933-2.462-3.5-5.5-3.5-1.746 0-3.332.483-4.5 1.253" />
                </svg>
                <span>Kelola Data Buku</span>
            </a>

            <a href="{{ route('admin.anggota.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.anggota.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4a4 4 0 00-8 0v4" />
                </svg>
                <span>Kelola Data Anggota</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.kategori.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                </svg>
                <span>Kelola Kategori</span>
            </a>

            <a href="{{ route('admin.transaksi.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.transaksi.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span>Transaksi Peminjaman</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.laporan.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6V7m4 10V3" />
                </svg>
                <span>Laporan</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.settings.*') ? 'bg-accent/30 text-white font-medium' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-80 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317a1.724 1.724 0 013.35 0 1.724 1.724 0 002.573 1.066 1.724 1.724 0 012.37 2.37 1.724 1.724 0 001.065 2.572 1.724 1.724 0 010 3.35 1.724 1.724 0 00-1.066 2.573 1.724 1.724 0 01-2.37 2.37 1.724 1.724 0 00-2.572 1.065 1.724 1.724 0 01-3.35 0 1.724 1.724 0 00-2.573-1.066 1.724 1.724 0 01-2.37-2.37 1.724 1.724 0 00-1.065-2.572 1.724 1.724 0 010-3.35 1.724 1.724 0 001.066-2.573 1.724 1.724 0 012.37-2.37 1.724 1.724 0 002.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Pengaturan</span>
            </a>
        </div>

        <div class="pt-4 border-t border-white/10">
            <button type="button" @click="logoutModalOpen = true"
                    class="flex items-center w-full gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 bg-secondary text-white hover:bg-camel font-medium shadow-md shadow-secondary/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                <span>Logout</span>
            </button>
        </div>
    </nav>
</aside>