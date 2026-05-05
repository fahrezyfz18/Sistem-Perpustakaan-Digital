<header class="relative flex items-center min-h-[85vh] overflow-hidden hero-bg">
    <div class="relative z-10 grid items-center max-w-7xl mx-auto px-4 gap-12 md:grid-cols-2 sm:px-6 lg:px-8">

        <!-- LEFT CONTENT -->
        <div class="space-y-8 animate-fade-in">

            <!-- BADGE -->
            <div class="inline-flex items-center gap-2 px-4 py-2 border rounded-full bg-olivine/10 border-olivine/20">
                <span class="w-2 h-2 bg-asparagus rounded-full animate-ping"></span>
                <span class="text-xs font-bold tracking-widest uppercase text-asparagus">
                    Portal Perpustakaan Digital
                </span>
            </div>

            <!-- TITLE -->
            <h1 class="text-5xl font-extrabold leading-[1.1] text-kombu md:text-7xl">
                Selamat Datang di
                <span class="text-asparagus">LeafShelf</span>
            </h1>

            <!-- DESCRIPTION -->
            <div class="relative pl-6">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-camel rounded-full"></div>

                <p class="text-lg font-medium leading-relaxed text-gray-600 md:text-xl">
                    Kembangkan wawasanmu bersama
                    <span class="font-bold text-kombu">LeafShelf</span>.
                    Temukan perpustakaan digital yang tenang dengan ribuan judul pilihan
                    untuk mendukung perjalanan pengembangan dirimu.
                </p>
            </div>

            <!-- CTA -->
            <div class="flex flex-wrap gap-4">
                <a href="#koleksi"
                    class="flex items-center gap-3 px-10 py-4 font-bold text-white transition-all shadow-2xl rounded-xl bg-kombu shadow-kombu/30 hover:bg-asparagus hover:scale-105">
                    Turn a New Leaf!
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div>

        <!-- RIGHT IMAGE -->
        <div class="relative flex justify-center">
            <div class="relative z-10">

                <img src="{{ asset('images/welcome.png') }}" alt="LeafShelf Digital Library Illustration" class="w-full max-w-lg mx-auto border-8 border-white rounded-[3rem] p-4 
                           drop-shadow-[0_40px_40px_rgba(54,78,49,0.25)]">

                <!-- GLOW -->
                <div class="absolute w-32 h-32 rounded-full -bottom-10 -right-10 bg-camel/20 blur-3xl"></div>

            </div>
        </div>

    </div>
</header>