<aside class="w-64 h-screen bg-primary text-white fixed shadow-xl font-sans">

    <!-- HEADER -->
    <div class="h-16 px-6 flex items-center border-b border-accent text-lg font-semibold">
        User Panel
    </div>

    <!-- MENU -->
    <nav class="p-4 space-y-2 text-sm">

        <!-- Dashboard -->
        <a href="{{ route('user.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V12H9v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z" />
            </svg>

            Dashboard
        </a>

        <!-- Daftar Buku -->
        <a href="{{ route('user.books.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6l8 4-8 4-8-4 8-4z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 10v6l8 4 8-4v-6" />
            </svg>

            Daftar Buku
        </a>

        <!-- Filter Buku -->
        <a href="{{ route('user.books.filter') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4h18M6 8h12M10 12h4M12 16h2" />
            </svg>

            Filter Buku
        </a>

        <!-- Peminjaman -->
        <a href="{{ route('user.borrow.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 13l4 4L19 7" />
            </svg>

            Peminjaman Buku
        </a>

        <!-- Status -->
        <a href="{{ route('user.borrow.status') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-6h13M9 11V7h13" />
            </svg>

            Status Peminjaman
        </a>

        <!-- Profil -->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-accent transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A10 10 0 0112 15a10 10 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>

            Kelola Profil
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="pt-4">
            @csrf

            <button class="w-full flex items-center gap-3 px-4 py-2 bg-secondary rounded-lg hover:bg-camel transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>

                Logout
            </button>
        </form>

    </nav>

</aside>