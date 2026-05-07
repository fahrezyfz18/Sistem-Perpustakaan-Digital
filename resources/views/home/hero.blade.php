<!-- =========================================================
     HERO SECTION
========================================================= -->
<header class="relative flex min-h-screen items-center overflow-hidden
           bg-gradient-to-br
           from-[#E6EDD8]
           via-[#DEE8CF]
           to-[#D2DFC1]">

    <!-- =====================================================
         BACKGROUND GLOW
    ====================================================== -->

    <!-- LEFT LIGHT -->
    <div class="absolute -left-[100px] -top-[100px]
               h-[500px] w-[500px]
               rounded-full
               bg-white/20
               blur-3xl"></div>

    <!-- RIGHT GLOW -->
    <div class="absolute -bottom-[120px] -right-[100px]
               h-[600px] w-[600px]
               rounded-full
               bg-asparagus/20
               blur-3xl"></div>

    <!-- =====================================================
         MAIN CONTAINER
    ====================================================== -->
    <div class="relative z-10
               grid h-full w-full items-stretch
               lg:grid-cols-[42%_58%]">

        <!-- =================================================
             LEFT CONTENT
        ================================================== -->
        <section class="flex flex-col justify-center
                   space-y-6 md:space-y-8
                   px-8 py-12
                   md:px-10
                   lg:pl-32 lg:pr-10 lg:py-20 lg:pb-48
                   animate-fade-in">

            <!-- =============================================
                 BADGE
            ============================================== -->
            <div class="inline-flex w-fit items-center gap-2
                       rounded-full
                       border border-olivine/20
                       bg-olivine/10
                       px-4 py-2">

                <!-- BADGE INDICATOR -->
                <span class="h-2 w-2
                           animate-ping
                           rounded-full
                           bg-asparagus"></span>

                <!-- BADGE TEXT -->
                <span class="text-[10px] font-bold uppercase tracking-widest
                           text-asparagus md:text-xs">
                    Portal Perpustakaan Digital
                </span>
            </div>

            <!-- =============================================
                 MAIN TITLE
            ============================================== -->
            <h1 class="max-w-xl
                       text-5xl font-extrabold leading-tight tracking-tight
                       text-kombu
                       md:text-6xl
                       lg:text-7xl">
                Selamat Datang di

                <span class="text-asparagus">
                    LeafShelf
                </span>
            </h1>

            <!-- =============================================
                 MOBILE HERO IMAGE
            ============================================== -->
            <div class="block w-full py-2 lg:hidden">

                <div class="relative mx-auto w-full max-w-[350px]">

                    <img src="{{ asset('images/welcome.png') }}" alt="LeafShelf Mobile Illustration" loading="eager"
                        decoding="async" class="h-auto w-full
                               animate-float
                               rounded-[2rem]
                               object-contain
                               mix-blend-multiply
                               drop-shadow-xl">
                </div>
            </div>

            <!-- =============================================
                 DESCRIPTION
            ============================================== -->
            <div class="relative max-w-lg pl-6">

                <!-- ACCENT LINE -->
                <div class="absolute bottom-0 left-0 top-0
                           w-1.5
                           rounded-full
                           bg-camel"></div>

                <!-- DESCRIPTION TEXT -->
                <p class="text-lg font-medium leading-relaxed
                           text-gray-600
                           md:text-xl">
                    Kembangkan wawasanmu bersama
                    <span class="font-bold text-kombu">
                        LeafShelf
                    </span>.

                    Temukan perpustakaan digital yang tenang
                    dengan ribuan judul pilihan untuk mendukung
                    perjalanan pengembangan dirimu.
                </p>
            </div>

            <!-- =============================================
                 CALL TO ACTION
            ============================================== -->
            <div class="flex flex-wrap gap-4">

                <!-- CTA BUTTON -->
                <a href="#koleksi" aria-label="Lihat koleksi LeafShelf" class="flex items-center gap-3
                           rounded-xl
                           bg-kombu
                           px-10 py-4
                           font-bold text-white
                           shadow-2xl shadow-kombu/30
                           transition-all duration-300
                           hover:scale-105
                           hover:bg-asparagus
                           active:scale-95">

                    <span>
                        Turn a New Leaf!
                    </span>

                    <!-- ICON -->
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>

        <!-- =================================================
             RIGHT IMAGE
        ================================================== -->
        <section class="relative hidden
           min-h-screen
           overflow-hidden
           lg:flex
           items-center
           justify-end">

            <!-- MAIN GLOW -->
            <div class="absolute right-10
                       h-[650px] w-[650px]
                       rounded-full
                       bg-white/20
                       blur-3xl"></div>

            <!-- SECONDARY GLOW -->
            <div class="absolute bottom-0 right-0
                       h-[400px] w-[400px]
                       rounded-full
                       bg-asparagus/20
                       blur-3xl"></div>

            <!-- HERO IMAGE DESKTOP -->
            <img src="{{ asset('images/welcome_transparan.png') }}" alt="LeafShelf Illustration" loading="eager"
                decoding="async" class="absolute inset-0
           h-full w-full
           scale-110
           object-cover
           object-right
           mix-blend-multiply
           drop-shadow-[0_30px_60px_rgba(54,78,49,0.18)]">
        </section>
    </div>
</header>