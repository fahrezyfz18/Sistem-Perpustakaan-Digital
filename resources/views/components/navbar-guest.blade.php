<nav class="bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center h-20">

            <!-- Logo -->
            <div class="flex-shrink-0 w-64">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/LOGO_LS.jpg') }}" alt="LeafShelf Logo"
                        class="h-24 w-auto object-contain">
                </a>
            </div>

            <!-- Menu -->
            <div class="hidden md:flex flex-1 justify-center items-center space-x-10">

                <!-- HOME -->
                <a href="/"
                    class="text-[13px] font-black uppercase tracking-[0.2em]
                    {{ request()->is('/') ? 'text-asparagus' : 'text-slate-500 hover:text-asparagus' }}
                    transition relative group">

                    Home

                    <span class="absolute -bottom-1 left-0 w-full h-0.5 rounded-full
                        {{ request()->is('/') ? 'bg-asparagus' : 'bg-transparent group-hover:bg-asparagus' }}">
                    </span>
                </a>

                <!-- COLLECTION -->
                <a href="#koleksi"
                    class="text-[13px] font-bold uppercase tracking-[0.2em]
                    text-slate-500 hover:text-asparagus transition">
                    Koleksi
                </a>

                <!-- SERVICES -->
                <a href="#layanan"
                    class="text-[13px] font-bold uppercase tracking-[0.2em]
                    text-slate-500 hover:text-asparagus transition">
                    Layanan
                </a>

                <!-- ABOUT -->
                <a href="#about"
                    class="text-[13px] font-bold uppercase tracking-[0.2em]
                    text-slate-500 hover:text-asparagus transition">
                    Tentang Kami
                </a>

            </div>

            <!-- Auth -->
            <div class="flex-shrink-0 w-64 flex justify-end items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-[11px] font-bold uppercase tracking-widest text-kombu hover:text-asparagus transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-[13px] font-bold uppercase tracking-widest text-kombu hover:text-asparagus transition">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="bg-olivine hover:bg-asparagus text-white px-8 py-3 rounded-full text-[13px] font-black uppercase tracking-tighter shadow-md transition-all transform hover:scale-105 active:scale-95">
                            Daftar
                        </a>
                    @endauth
                @endif
            </div>

        </div>
    </div>
</nav>