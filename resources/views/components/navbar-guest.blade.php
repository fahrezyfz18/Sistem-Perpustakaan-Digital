<nav class="bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-20">

            <!-- LOGO -->
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <img 
                        src="{{ asset('images/LOGO_LS_TRANSPARAN.png') }}" 
                        alt="LeafShelf Logo"
                        class="h-14 w-auto object-contain 
                               drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)]
                               hover:drop-shadow-[0_6px_10px_rgba(0,0,0,0.3)]
                               transition duration-300"
                    >
                </a>
            </div>

            <!-- DESKTOP MENU -->
            <div class="hidden md:flex flex-1 justify-center items-center gap-8">

                <a href="{{ route('home') }}"
                    class="text-[13px] font-black uppercase tracking-[0.2em]
                    {{ request()->routeIs('home') ? 'text-asparagus' : 'text-slate-500' }}
                    hover:text-asparagus transition">
                    Beranda
                </a>

                <a href="#koleksi"
                    class="text-[13px] font-bold uppercase tracking-[0.2em]
                    text-slate-500 hover:text-asparagus transition">
                    Koleksi
                </a>

                <a href="#layanan"
                    class="text-[13px] font-bold uppercase tracking-[0.2em]
                    text-slate-500 hover:text-asparagus transition">
                    Layanan
                </a>

                <a href="#about"
                    class="text-[13px] font-bold uppercase tracking-[0.2em]
                    text-slate-500 hover:text-asparagus transition">
                    Tentang Kami
                </a>

            </div>

            <!-- AUTH DESKTOP -->
            <div class="hidden md:flex items-center gap-6">

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-[12px] font-bold uppercase tracking-widest 
                                   text-kombu hover:text-asparagus transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-[13px] font-bold uppercase tracking-widest 
                                   text-kombu hover:text-asparagus transition">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="bg-olivine hover:bg-asparagus text-white 
                                   px-6 py-2 rounded-full text-[12px] font-black 
                                   uppercase tracking-wide shadow-md 
                                   transition-all transform hover:scale-105 active:scale-95">
                            Daftar
                        </a>
                    @endauth
                @endif

            </div>

            <!-- MOBILE BUTTON -->
            <div class="md:hidden">
                <button id="menu-btn" class="text-kombu focus:outline-none">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-6 bg-white border-t border-gray-100">

        <div class="flex flex-col gap-4 mt-4 text-center">

            <a href="{{ route('home') }}" class="text-sm font-bold text-slate-600 hover:text-asparagus">
                Beranda
            </a>

            <a href="#koleksi" class="text-sm font-bold text-slate-600 hover:text-asparagus">
                Koleksi
            </a>

            <a href="#layanan" class="text-sm font-bold text-slate-600 hover:text-asparagus">
                Layanan
            </a>

            <a href="#about" class="text-sm font-bold text-slate-600 hover:text-asparagus">
                Tentang Kami
            </a>

            <div class="border-t pt-4 flex flex-col gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-kombu">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-kombu">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-olivine text-white py-2 rounded-full text-sm font-bold">
                        Daftar
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>