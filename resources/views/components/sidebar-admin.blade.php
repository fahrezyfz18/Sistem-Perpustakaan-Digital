<aside class="w-64 h-screen bg-primary text-white fixed shadow-xl font-sans">
    
    <!-- Logo / Title -->
    <div class="p-6 text-2xl font-semibold border-b border-accent flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-olivine" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6l-2-2m0 0L8 6m2-2v6m0 0l2 2m-2-2l-2 2m6 4H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
        </svg>
        Admin Panel
    </div>

    <!-- Menu -->
    <nav class="p-4 space-y-3 text-base">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
            </svg>
            Dashboard
        </a>

        <!-- Buku -->
        <a href="{{ route('admin.buku.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m8-6H4"/>
            </svg>
            Kelola Data Buku
        </a>

        <!-- Anggota -->
        <a href="{{ route('admin.anggota.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4a4 4 0 00-8 0v4m8 0H9"/>
            </svg>
            Kelola Data Anggota
        </a>

        <!-- Pengembalian -->
        <a href="{{ route('admin.pengembalian.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M5 19a9 9 0 0114-14"/>
            </svg>
            data Pengembalian
        </a>

        <!-- Laporan -->
        <a href="{{ route('admin.laporan.peminjaman') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6V7m4 10V3"/>
            </svg>
            Laporan Peminjaman
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button class="w-full flex items-center gap-3 px-4 py-2 bg-secondary rounded-lg hover:bg-camel transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                </svg>
                Logout
            </button>
        </form>

    </nav>
</aside>