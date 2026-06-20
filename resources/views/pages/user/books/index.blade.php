@extends('layouts.user')

@section('content')

    <div class="p-6 bg-background min-h-screen">

        <!-- HEADER -->
        <div class="mb-6">

            <h1 class="text-2xl md:text-3xl font-bold text-kombu">
                Daftar Buku
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Cari dan pinjam buku favoritmu
            </p>

        </div>

        <!-- SEARCH & FILTER -->
        <div class="bg-white rounded-xl shadow p-4 mb-6">

            <form action="{{ route('user.books.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">

                <!-- SEARCH INPUT -->
                <div class="md:col-span-3">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau penulis..." class="w-full border border-gray-300 rounded-lg px-4 py-2
                                   focus:ring-2 focus:ring-primary
                                   focus:border-primary outline-none">

                </div>

                <!-- CATEGORY -->
                <div>

                    <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2
                                   focus:ring-2 focus:ring-primary
                                   focus:border-primary outline-none">

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>

                                {{ $category }}

                            </option>

                        @endforeach

                    </select>

                </div>
            </form>
        </div>


        <!-- BOOK GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            @forelse($books as $book)

                <div class="bg-white rounded-2xl shadow overflow-hidden
                                        hover:shadow-lg transition duration-300">

                    <!-- COVER -->
                    <div class="h-64 bg-gray-100 overflow-hidden">

                        @if($book->cover)

                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}"
                                class="w-full h-full object-cover">

                        @else

                            <div class="w-full h-full flex items-center justify-center text-gray-400">

                                No Cover

                            </div>

                        @endif

                    </div>

                    <!-- CONTENT -->
                    <div class="p-4">

                        <!-- JUDUL -->
                        <h2 class="font-semibold text-kombu text-lg line-clamp-1">

                            {{ $book->judul }}

                        </h2>

                        <!-- PENULIS -->
                        <p class="text-sm text-gray-500 mt-1">

                            {{ $book->penulis }}

                        </p>

                        <!-- CATEGORY & STOCK -->
                        <div class="flex items-center justify-between mt-4">

                            <span class="text-xs bg-olivine text-white px-3 py-1 rounded-full">

                                {{ $book->kategori }}

                            </span>

                            <span class="text-sm font-semibold text-primary">

                                Stok: {{ $book->stok }}

                            </span>

                        </div>

                        <!-- BUTTON -->
                        <a href="{{ route('user.books.show', $book->id) }}" class="mt-4 block text-center bg-primary text-white
                                               py-2 rounded-lg hover:bg-accent transition">

                            Detail Buku

                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center py-10 text-gray-500">

                    Buku tidak ditemukan

                </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-8">

            {{ $books->links() }}

        </div>

    </div>

@endsection