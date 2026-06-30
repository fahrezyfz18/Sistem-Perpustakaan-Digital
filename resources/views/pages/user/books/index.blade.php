@extends('layouts.user')

@section('content')

    <div class="p-6 bg-background min-h-screen">

        <!-- =========================
                             PAGE HEADER
                        ========================== -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-extrabold text-kombu tracking-tight">
                Daftar Buku
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Cari, temukan, dan pinjam buku favoritmu dengan mudah.
            </p>
        </div>

        <!-- =========================
                             SEARCH & CATEGORY FILTER
                        ========================== -->
        <div class="bg-white rounded-xl shadow p-4 mb-6">

            <form action="{{ route('user.books.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">

                <!-- Search Input -->
                <div class="md:col-span-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau penulis..." class="w-full border border-gray-300 rounded-lg px-4 py-2
                                               focus:ring-2 focus:ring-primary
                                               focus:border-primary outline-none">
                </div>

                <!-- Category Filter -->
                <div>
                    <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none">
                        <option value="">Semua Kategori</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </form>

        </div>

        <!-- =========================
                             BOOK LIST
             ========================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

            @forelse ($books as $book)

                <!-- Book Card -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden
                                                           hover:shadow-lg hover:-translate-y-1 transition-all duration-300
                                                           flex flex-col h-full">

                    <!-- Book Cover -->
                    <div class="w-full aspect-[3/4] bg-gray-50 overflow-hidden relative border-b border-gray-100">

                        @if ($book->cover)

                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover
                                                                                       group-hover:scale-105
                                                                                       transition-transform duration-500">

                        @else

                            <!-- Default Cover -->
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 gap-2 p-4">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 stroke-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5
                                                                                           5S4.168 5.477 3 6.253v13C4.168 18.477
                                                                                           5.754 18 7.5 18s3.332.477 4.5 1.253m0-13
                                                                                           C13.168 5.477 14.754 5 16.5 5c1.747 0
                                                                                           3.332.477 4.5 1.253v13C19.832 18.477
                                                                                           18.247 18 16.5 18c-1.746
                                                                                           0-3.332.477-4.5 1.253" />
                                </svg>

                                <span class="text-xs font-medium">
                                    No Cover Available
                                </span>

                            </div>

                        @endif

                    </div>

                    <!-- Book Information -->
                    <div class="p-4 flex-1 flex flex-col justify-between">

                        <div>

                            <!-- Book Title -->
                            <h2 class="font-bold text-kombu text-base md:text-lg
                                                                       line-clamp-2 leading-snug
                                                                       group-hover:text-primary
                                                                       transition-colors duration-300"
                                title="{{ $book->judul }}">
                                {{ $book->judul }}
                            </h2>

                            <!-- Author -->
                            <p class="text-sm text-gray-500 mt-1.5 line-clamp-1">
                                {{ $book->penulis }}
                            </p>

                        </div>

                        <div class="mt-4">

                            <!-- Category & Stock -->
                            <div class="flex items-center justify-between text-xs font-medium border-t border-gray-50 pt-3">

                                <span class="bg-olivine/10 text-olivine px-2.5 py-1 rounded-md tracking-wide">
                                    {{ $book->category->nama ?? 'Tanpa Kategori' }}
                                </span>

                                <span class="{{ $book->stok > 0 ? 'text-primary' : 'text-red-500' }}">
                                    Stok: {{ $book->stok }}
                                </span>

                            </div>

                            <!-- Detail Button -->
                            <a href="{{ route('user.books.show', $book->id) }}" class="mt-3 py-2 text-sm block text-center
                                                                       bg-primary text-white
                                                                       text-sm font-semibold
                                                                       py-2.5 px-4 rounded-xl
                                                                       hover:bg-accent
                                                                       transition-colors duration-300
                                                                       shadow-sm hover:shadow">
                                Detail Buku
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <!-- Empty State -->
                <div
                    class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm text-gray-400">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto stroke-1 text-gray-300 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656
                                                               0M9 10h.01M15 10h.01M21
                                                               12a9 9 0 11-18 0 9 9
                                                               0 0118 0z" />
                    </svg>

                    <p class="text-base font-medium text-gray-500">
                        Buku tidak ditemukan
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Coba gunakan kata kunci pencarian atau kategori lain.
                    </p>

                </div>

            @endforelse

        </div>

        <!-- =========================
                             PAGINATION
                        ========================== -->
        <div class="mt-10 flex justify-center md:justify-end">
            {{ $books->links() }}
        </div>

    </div>

@endsection