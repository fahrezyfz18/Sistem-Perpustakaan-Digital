@extends('layouts.user')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- COVER -->
            <div class="p-6">

                @if($book->cover)

                    <img
                        src="{{ asset('storage/' . $book->cover) }}"
                        alt="{{ $book->judul }}"
                        class="w-full rounded-xl shadow">

                @else

                    <div class="h-96 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">

                        No Cover

                    </div>

                @endif

            </div>

            <!-- CONTENT -->
            <div class="md:col-span-2 p-6">

                <!-- TITLE -->
                <h1 class="text-3xl font-bold text-kombu">

                    {{ $book->judul }}

                </h1>

                <!-- AUTHOR -->
                <p class="text-gray-500 mt-2">

                    {{ $book->penulis }}

                </p>

                <!-- DETAIL -->
                <div class="mt-6 space-y-3">

                    <div>

                        <span class="font-semibold">
                            ISBN:
                        </span>

                        {{ $book->isbn }}

                    </div>

                    <div>

                        <span class="font-semibold">
                            Penerbit:
                        </span>

                        {{ $book->penerbit }}

                    </div>

                    <div>

                        <span class="font-semibold">
                            Tahun:
                        </span>

                        {{ $book->tahun }}

                    </div>

                    <div>

                        <span class="font-semibold">
                            Kategori:
                        </span>

                        {{ $book->kategori }}

                    </div>

                    <div>

                        <span class="font-semibold">
                            Stok:
                        </span>

                        {{ $book->stok }}

                    </div>

                </div>

                <!-- DESKRIPSI -->
                <div class="mt-6">

                    <h3 class="font-semibold text-lg text-kombu mb-2">

                        Deskripsi

                    </h3>

                    <p class="text-gray-600 leading-relaxed">

                        {{ $book->deskripsi ?? 'Tidak ada deskripsi buku.' }}

                    </p>

                </div>

                <!-- ACTION -->
                <div class="mt-8">

                    @if($book->stok > 0)

                        <form
                            action="{{ route('user.borrow.store', $book->id) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="w-full md:w-auto bg-primary text-white
                                       px-6 py-3 rounded-xl
                                       hover:bg-accent transition">

                                Pinjam Buku

                            </button>

                        </form>

                    @else

                        <button
                            disabled
                            class="w-full md:w-auto bg-gray-400 text-white
                                   px-6 py-3 rounded-xl cursor-not-allowed">

                            Stok Habis

                        </button>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection