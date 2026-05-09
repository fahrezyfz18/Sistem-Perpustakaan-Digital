@extends('layouts.app')

@section('content')

<div class="p-6 bg-background min-h-screen">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-2xl font-semibold text-kombu">
            Buku Saya
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Buku yang sedang Anda pinjam
        </p>

    </div>

    <!-- BOOK GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($books as $book)

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <!-- COVER -->
                <div class="h-64 overflow-hidden bg-gray-100">

                    @if($book->cover)

                        <img
                            src="{{ asset('storage/' . $book->cover) }}"
                            class="w-full h-full object-cover">

                    @endif

                </div>

                <!-- CONTENT -->
                <div class="p-4">

                    <h3 class="font-semibold text-kombu">
                        {{ $book->judul }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $book->penulis }}
                    </p>

                    <div class="mt-4">

                        <span class="bg-mustard text-white text-xs px-3 py-1 rounded">
                            Sedang Dipinjam
                        </span>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full text-center py-10 text-gray-500">

                Anda belum meminjam buku

            </div>

        @endforelse

    </div>

</div>

@endsection