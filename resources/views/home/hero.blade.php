<!-- =========================================================
     HERO SECTION
========================================================= -->
   <header class="relative
               flex
               min-h-[calc(100vh-80px)]
               items-center
               overflow-hidden
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
                blur-3xl">
    </div>

    <!-- RIGHT GLOW -->
    <div class="absolute -bottom-[120px] -right-[100px]
                h-[900px] w-[900px]
                rounded-full
                bg-asparagus/20
                blur-3xl">
    </div>

    <!-- =====================================================
         MAIN CONTAINER
    ====================================================== -->
    <div class="relative z-10
                container-page
                grid
                w-full
                items-center
                gap-8
                py-12
                lg:grid-cols-[50%_50%]
                lg:py-0">

        <!-- =================================================
             LEFT CONTENT
        ================================================== -->
        <section class="flex flex-col
                        justify-center
                        space-y-6
                        md:space-y-8
                        lg:pr-10
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
                             bg-asparagus">
                </span>

                <!-- BADGE TEXT -->
                <span class="text-[10px]
                             font-bold
                             uppercase
                             tracking-widest
                             text-asparagus
                             md:text-xs">
                    Portal Perpustakaan Digital
                </span>
            </div>

            <!-- =============================================
                 MAIN TITLE
            ============================================== -->
            <h1 class="max-w-xl
                       text-4xl
                       font-extrabold
                       leading-tight
                       tracking-tight
                       text-kombu
                       sm:text-5xl
                       md:text-6xl
                       lg:text-7xl
                       xl:text-8xl">

                Selamat Datang di

                <span class="block text-asparagus sm:inline">
                    LeafShelf
                </span>

            </h1>

            <!-- =============================================
                 MOBILE HERO IMAGE
            ============================================== -->
            <div class="block py-4 lg:hidden">

                <div class="relative mx-auto
                            w-full
                            max-w-[260px]
                            sm:max-w-[300px]
                            md:max-w-[340px]">

                    <img src="{{ asset('images/hero_transparan.png') }}"
                         alt="LeafShelf Mobile Illustration"
                         loading="eager"
                         decoding="async"
                         class="w-full
                                h-auto
                                object-contain
                                animate-float
                                drop-shadow-xl
                                mix-blend-multiply">

                </div>

            </div>

            <!-- =============================================
                 DESCRIPTION
            ============================================== -->
            <div class="relative max-w-lg pl-6">

                <!-- ACCENT LINE -->
                <div class="absolute inset-y-0 left-0
                            w-1.5
                            rounded-full
                            bg-camel">
                </div>

                <!-- DESCRIPTION TEXT -->
                <p class="text-base
                          font-medium
                          leading-relaxed
                          text-gray-600
                          md:text-lg">

                    Kembangkan wawasanmu bersama

                    <span class="font-bold text-kombu">
                        LeafShelf
                    </span>

                    Temukan perpustakaan digital yang tenang
                    dengan ribuan judul pilihan untuk mendukung
                    perjalanan pengembangan dirimu.

                </p>

            </div>

            <!-- =============================================
                 CALL TO ACTION
            ============================================== -->
            <div class="flex flex-wrap gap-4 pt-2">

                <!-- CTA BUTTON -->
                <a href="#koleksi"
                   aria-label="Lihat koleksi LeafShelf"
                   class="flex items-center gap-3
                          rounded-xl
                          bg-kombu
                          px-8 py-3.5
                          md:px-10 md:py-4
                          font-bold
                          text-white
                          shadow-2xl
                          shadow-kombu/30
                          transition-all
                          duration-300
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
        <section class="hidden
                        lg:flex
                        relative
                        items-center
                        justify-center">

            <!-- MAIN GLOW -->
            <div class="absolute
                        right-5
                        h-[650px]
                        w-[650px]
                        rounded-full
                        bg-white/20
                        blur-3xl">
            </div>

            <!-- SECONDARY GLOW -->
            <div class="absolute
                        bottom-0
                        right-0
                        h-[400px]
                        w-[400px]
                        rounded-full
                        bg-asparagus/20
                        blur-3xl">
            </div>

            <!-- HERO IMAGE DESKTOP -->
            <img src="{{ asset('images/hero_transparan.png') }}"
                 alt="LeafShelf Illustration"
                 loading="eager"
                 decoding="async"
                 class="mx-auto
                        h-auto
                        w-full
                        max-w-xl
                        object-contain
                        drop-shadow-2xl
                        xl:max-w-2xl">

        </section>

    </div>

</header>