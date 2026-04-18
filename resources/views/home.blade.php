<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeafShelf - Portal Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        olivine: '#9AB283',
                        asparagus: '#8FA96D',
                        kombu: '#364E31',
                        mustard: '#756633',
                        camel: '#BC9E5F',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        .hero-bg {
            background: radial-gradient(circle at top right, rgba(154, 178, 131, 0.15), transparent),
                radial-gradient(circle at bottom left, rgba(188, 158, 95, 0.1), transparent);
        }
    </style>
</head>

<body class="bg-slate-50 text-kombu">

    <!-- Navigation utama untuk akses halaman utama dan autentikasi -->
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

                    <a href="#" class="text-[13px] font-black uppercase tracking-[0.2em]
                          text-asparagus hover:text-kombu transition relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-asparagus rounded-full"></span>
                    </a>

                    <a href="#koleksi" class="text-[13px] font-bold uppercase tracking-[0.2em]
                          text-slate-500 hover:text-asparagus transition">
                        Collections
                    </a>

                    <a href="#layanan"
                        class="text-[13px] font-bold uppercase tracking-[0.2em] text-slate-500 hover:text-asparagus transition">
                        Services
                    </a>

                    <a href="#about"
                        class="text-[13px] font-bold uppercase tracking-[0.2em] text-slate-500 hover:text-asparagus transition">
                        About Us
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
                                Register
                            </a>
                        @endauth
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <!-- Hero section utama untuk memperkenalkan aplikasi LeafShelf -->
    <header class="relative min-h-[85vh] flex items-center overflow-hidden hero-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="space-y-8 animate-fade-in">
                <div
                    class="inline-flex items-center gap-2 bg-olivine/10 px-4 py-2 rounded-full border border-olivine/20">
                    <span class="w-2 h-2 bg-asparagus rounded-full animate-ping"></span>
                    <span class="text-xs font-bold text-asparagus uppercase tracking-widest">Digital Library
                        Portal</span>

                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-kombu leading-[1.1]">
                    Welcome to <span class="text-asparagus">LeafShelf</span>
                </h1>

                <div class="relative pl-6">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-camel rounded-full"></div>
                    <p class="text-lg md:text-xl text-gray-600 leading-relaxed font-medium">
                        Nurture your insights with <span class="text-kombu font-bold">LeafShelf</span>. Discover a
                        serene digital library featuring thousands of handpicked titles to support your journey of
                        personal growth.
                    </p>
                </div>

                <div class="flex gap-4">
                    <a href="#koleksi"
                        class="bg-kombu text-white px-10 py-4 rounded-xl font-bold shadow-2xl shadow-kombu/30 hover:scale-105 hover:bg-asparagus transition-all flex items-center gap-3">
                        Turn a New Leaf! <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="relative flex justify-center">
                <div class="relative z-10">
                    <img src="{{ asset('images/welcome.png') }}" alt="LeafShelf Digital Portal Illustration"
                        class="w-full max-w-lg mx-auto drop-shadow-[0_50px_50px_rgba(54,78,49,0.25)] rounded-[3rem] border-8 border-white p-4">
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-camel/20 rounded-full blur-3xl"></div>
            </div>
        </div>
    </header>

    <section id="layanan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h4 class="text-mustard font-bold uppercase tracking-[0.3em] text-xs mb-4">What We Offer</h4>
            <h2 class="text-4xl font-black text-kombu mb-16 italic">Premium Digital Services</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 border border-olivine/10 rounded-[2rem] hover:bg-olivine/5 transition-all group">
                    <div
                        class="w-14 h-14 bg-kombu rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-12 transition">
                        <i class="fas fa-book-open text-olivine text-xl"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-3">E-Book Access</h4>
                    <p class="text-sm text-gray-500">Access thousands of digital books anytime, anywhere.</p>
                </div>
                <div class="p-8 border border-olivine/10 rounded-[2rem] hover:bg-olivine/5 transition-all group">
                    <div
                        class="w-14 h-14 bg-asparagus rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-12 transition">
                        <i class="fas fa-history text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-3">Online Booking</h4>
                    <p class="text-sm text-gray-500">Skip the line with easy physical book reservations.</p>
                </div>
                <div class="p-8 border border-olivine/10 rounded-[2rem] hover:bg-olivine/5 transition-all group">
                    <div
                        class="w-14 h-14 bg-mustard rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-12 transition">
                        <i class="fas fa-search text-white text-xl"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-3">Smart Search</h4>
                    <p class="text-sm text-gray-500">Find scholarly references with smart-search algorithms.</p>
                </div>
    </section>

    <section id="koleksi" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="text-4xl font-black text-kombu">New <span class="text-asparagus">Collection</span></h2>
                    <p class="text-gray-500 mt-2 italic">Recommended reads for this week.</p>
                </div>
                <a href="#"
                    class="bg-kombu text-white px-8 py-3 rounded-full font-bold text-sm shadow-lg hover:bg-asparagus transition">Explore
                    All</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
                <div class="group">
                    <div class="relative overflow-hidden rounded-[2rem] aspect-[3/4] shadow-xl mb-6">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=400"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-kombu to-transparent translate-y-full group-hover:translate-y-0 transition duration-500">
                            <button class="w-full py-3 bg-white text-kombu font-bold rounded-xl text-sm shadow-xl">Read
                                Now</button>
                        </div>
                    </div>
                    <h3 class="font-bold text-kombu text-lg">Seni Kehidupan Hijau</h3>
                    <p class="text-mustard text-xs font-bold uppercase tracking-widest mt-1">Science & Nature</p>
                </div>
                <div class="group">
                    <div class="relative overflow-hidden rounded-[2rem] aspect-[3/4] shadow-xl mb-6">
                        <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=400"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-kombu to-transparent translate-y-full group-hover:translate-y-0 transition duration-500">
                            <button class="w-full py-3 bg-white text-kombu font-bold rounded-xl text-sm shadow-xl">Read
                                Now</button>
                        </div>
                    </div>
                    <h3 class="font-bold text-kombu text-lg">Sejarah Nusantara</h3>
                    <p class="text-mustard text-xs font-bold uppercase tracking-widest mt-1">History</p>
                </div>
                <div class="group">
                    <div class="relative overflow-hidden rounded-[2rem] aspect-[3/4] shadow-xl mb-6">
                        <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?q=80&w=400"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-kombu to-transparent translate-y-full group-hover:translate-y-0 transition duration-500">
                            <button class="w-full py-3 bg-white text-kombu font-bold rounded-xl text-sm shadow-xl">Read
                                Now</button>
                        </div>
                    </div>
                    <h3 class="font-bold text-kombu text-lg">Logika Pemrograman</h3>
                    <p class="text-mustard text-xs font-bold uppercase tracking-widest mt-1">Technology</p>
                </div>
                <div class="group">
                    <div class="relative overflow-hidden rounded-[2rem] aspect-[3/4] shadow-xl mb-6">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=400"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-kombu to-transparent translate-y-full group-hover:translate-y-0 transition duration-500">
                            <button class="w-full py-3 bg-white text-kombu font-bold rounded-xl text-sm shadow-xl">Read
                                Now</button>
                        </div>
                    </div>
                    <h3 class="font-bold text-kombu text-lg">Masa Depan AI</h3>
                    <p class="text-mustard text-xs font-bold uppercase tracking-widest mt-1">Innovation</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-black text-kombu mb-6 italic">PBL Members Group 3</h2>
            <div class="h-2 w-20 bg-camel mx-auto rounded-full mb-20"></div>

            <div class="grid md:grid-cols-3 gap-16">
                <div class="group">
                    <div class="w-44 h-44 mx-auto mb-6 relative">
                        <div
                            class="absolute inset-0 bg-olivine rounded-[2.5rem] rotate-6 group-hover:rotate-12 transition">
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Member+1&background=364E31&color=fff&size=200"
                            class="relative w-full h-full rounded-[2.5rem] object-cover shadow-2xl">
                    </div>
                    <h3 class="text-xl font-bold text-kombu">Fathir Maretho Andrinov</h3>
                    <p class="text-sm font-bold text-mustard uppercase tracking-widest mt-1">Project Leader</p>
                </div>
                <div class="group text-center">
                    <div class="w-44 h-44 mx-auto mb-6 relative">
                        <div
                            class="absolute inset-0 bg-asparagus rounded-[2.5rem] rotate-6 group-hover:rotate-12 transition">
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Member+2&background=8FA96D&color=fff&size=200"
                            class="relative w-full h-full rounded-[2.5rem] object-cover shadow-2xl">
                    </div>
                    <h3 class="text-xl font-bold text-kombu">Fahrezi Falchah Fauzan</h3>
                    <p class="text-sm font-bold text-mustard uppercase tracking-widest mt-1"> Project Member 1</p>
                </div>
                <div class="group text-center">
                    <div class="w-44 h-44 mx-auto mb-6 relative">
                        <div
                            class="absolute inset-0 bg-camel rounded-[2.5rem] rotate-6 group-hover:rotate-12 transition">
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Member+3&background=BC9E5F&color=fff&size=200"
                            class="relative w-full h-full rounded-[2.5rem] object-cover shadow-2xl">
                    </div>
                    <h3 class="text-xl font-bold text-kombu">Lasma Angelina Sihombing</h3>
                    <p class="text-sm font-bold text-mustard uppercase tracking-widest mt-1">Project Member 2</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-kombu text-white pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-16 border-b border-white/5 pb-16">
            <div class="space-y-6 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2">
                    <div class="space-y-4">
                        <img src="{{ asset('images/LOGO_LS.jpg') }}" alt="LeafShelf Logo"
                            class="h-16 w-auto brightness-110 contrast-125">
                        <p class="text-olivine/60 text-sm leading-relaxed max-w-xs">
                            Sistem Perpustakaan Digital masa depan.
                        </p>
                    </div>
                </div>
                <p class="text-olivine/60 text-sm leading-relaxed">
                    Building a digital literacy bridge for a brighter future. Turn a New Leaf!
                </p>
            </div>
            <div class="space-y-6 text-center">
                <h4 class="text-camel font-bold tracking-widest uppercase text-sm">Quick Links</h4>
                <div class="flex flex-col gap-4 text-sm text-olivine/70 font-semibold">
                    <a href="#" class="hover:text-white transition">Collections</a>
                    <a href="#" class="hover:text-white transition">About Us</a>
                    <a href="#" class="hover:text-white transition">Services</a>
                </div>
            </div>
            <div class="space-y-6 text-center md:text-right">
                <h4 class="text-camel font-bold tracking-widest uppercase text-sm">Find Us</h4>
                <div class="text-sm text-olivine/70 space-y-2">
                    <p>Politeknik Negeri Batam</p>
                    <p>admin@leafshelf.sch.id</p>
                </div>
                <div class="flex justify-center md:justify-end gap-6 text-xl pt-4">
                    <i class="fab fa-instagram hover:text-white cursor-pointer transition"></i>
                    <i class="fab fa-facebook hover:text-white cursor-pointer transition"></i>
                    <i class="fab fa-whatsapp hover:text-white cursor-pointer transition"></i>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-12 text-center">
            <p class="text-[10px] text-olivine/30 uppercase tracking-[0.5em] font-black">
                &copy; 2026 PBL IF 2B-3 MALAM. All rights reserved.
            </p>
        </div>
    </footer>

</body>

</html>