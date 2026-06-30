@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-background py-8 px-6">

        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

            <!-- HEADER -->
            <div class="bg-primary text-white p-6">
                <h1 class="text-2xl font-bold">
                    Konfirmasi Pengembalian Buku
                </h1>

                <p class="text-sm text-gray-100 mt-1">
                    Pastikan data pengembalian sudah benar.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3">

                <!-- COVER -->
                <div class="bg-gray-50 p-6 flex justify-center items-center">

                    @if($book->book && $book->book->cover)

                        <img src="{{ asset('storage/' . $book->book->cover) }}" alt="{{ $book->book->judul }}"
                            class="rounded-xl shadow-md w-full max-w-xs object-cover">

                    @else

                        <div class="h-96 flex items-center justify-center text-gray-400">

                            No Cover

                        </div>

                    @endif

                </div>

                <!-- CONTENT -->
                <div class="lg:col-span-2 p-8">

                    @php

                        $hariTerlambat = 0;

                        if (
                            $book->tgl_jatuh_tempo &&
                            now()->startOfDay()->gt($book->tgl_jatuh_tempo->startOfDay())
                        ) {

                            $hariTerlambat = $book->tgl_jatuh_tempo
                                ->startOfDay()
                                ->diffInDays(now()->startOfDay());

                        }

                        $denda = $hariTerlambat * 2000;

                    @endphp

                    <!-- INFORMASI BUKU -->
                    <div class="space-y-3">

                        <div>
                            <span class="text-gray-500 text-sm">
                                Judul Buku
                            </span>

                            <p class="font-semibold text-kombu">

                                {{ $book->book->judul }}

                            </p>
                        </div>

                        <div>
                            <span class="text-gray-500 text-sm">
                                Penulis
                            </span>

                            <p class="font-semibold text-kombu">

                                {{ $book->book->penulis }}

                            </p>
                        </div>

                        <div>
                            <span class="text-gray-500 text-sm">
                                Tanggal Pinjam
                            </span>

                            <p class="font-medium">

                                {{ $book->tanggal_pinjam?->format('d M Y') ?? '-' }}

                            </p>
                        </div>

                        <div>
                            <span class="text-gray-500 text-sm">
                                Jatuh Tempo
                            </span>

                            <p class="font-medium">

                               {{ $book->tgl_jatuh_tempo?->format('d M Y') ?? '-' }}

                            </p>
                        </div>

                    </div>

                    <!-- DENDA -->
                    <div class="mt-8 rounded-xl border border-gray-200 bg-gray-50 p-5">

                        <div class="flex justify-between">

                            <span>

                                Hari Terlambat

                            </span>

                            <span class="font-semibold">

                                {{ $hariTerlambat }} Hari

                            </span>

                        </div>

                        <div class="flex justify-between mt-3">

                            <span>

                                Denda

                            </span>

                            <span class="font-bold text-red-500">

                                Rp {{ number_format($denda, 0, ',', '.') }}

                            </span>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <form action="{{ route('user.my-books.return', $book->id) }}" method="POST" class="mt-8">

                        @csrf

                        <div class="flex gap-4">

                            <a href="{{ route('user.my-books.detail', $book->id) }}"
                                class="flex-1 text-center border border-gray-300 py-3 rounded-xl hover:bg-gray-100 transition">

                                Batal

                            </a>

                            <button type="submit"
                                class="flex-1 bg-secondary text-white py-3 rounded-xl hover:bg-camel transition">

                                Konfirmasi Pengembalian

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection