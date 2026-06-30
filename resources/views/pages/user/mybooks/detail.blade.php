@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-background py-8 px-6">

        <div class="max-w-6xl mx-auto">

            <!-- CARD -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                <div class="grid grid-cols-1 lg:grid-cols-3">

                    <!-- ===================================================== -->
                    <!-- COVER BUKU -->
                    <!-- ===================================================== -->
                    <div class="bg-gray-50 flex justify-center items-center p-8">

                        @if($book->book && $book->book->cover)

                            <img src="{{ asset('storage/' . $book->book->cover) }}" alt="{{ $book->book->judul }}"
                                class="w-full max-w-xs rounded-xl shadow-md object-cover">

                        @else

                            <div class="h-96 flex items-center justify-center text-gray-400">

                                No Cover

                            </div>

                        @endif

                    </div>


                    <!-- ===================================================== -->
                    <!-- DETAIL -->
                    <!-- ===================================================== -->
                    <div class="lg:col-span-2 p-8">

                        <!-- JUDUL -->
                        <h1 class="text-3xl font-bold text-kombu">

                            {{ $book->book->judul }}

                        </h1>

                        <!-- PENULIS -->
                        <p class="text-gray-500 mt-2">

                            {{ $book->book->penulis }}

                        </p>


                        <!-- STATUS -->
                        <div class="mt-5">

                            @if($book->status == 'dipinjam')

                                <span class="bg-mustard text-white text-xs px-4 py-2 rounded-full">

                                    Sedang Dipinjam

                                </span>

                            @else

                                <span class="bg-olivine text-white text-xs px-4 py-2 rounded-full">

                                    Sudah Dikembalikan

                                </span>

                            @endif

                        </div>


                        <!-- ===================================================== -->
                        <!-- INFORMASI -->
                        <!-- ===================================================== -->
                        <div class="grid md:grid-cols-2 gap-8 mt-8">

                            <!-- INFORMASI BUKU -->
                            <div>

                                <h3 class="font-semibold text-kombu mb-4">

                                    Informasi Buku

                                </h3>

                                <div class="space-y-3 text-sm">

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            ISBN

                                        </span>

                                        <span>

                                            {{ $book->book->isbn }}

                                        </span>

                                    </div>

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            Penerbit

                                        </span>

                                        <span>

                                            {{ $book->book->penerbit }}

                                        </span>

                                    </div>

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            Kategori

                                        </span>

                                        <span>

                                            {{ $book->book->category->nama ?? '-' }}

                                        </span>

                                    </div>

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            Tahun

                                        </span>

                                        <span>

                                            {{ $book->book->tahun }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            <!-- INFORMASI PEMINJAMAN -->
                            <div>

                                <h3 class="font-semibold text-kombu mb-4">

                                    Informasi Peminjaman

                                </h3>

                                <div class="space-y-3 text-sm">

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            Tanggal Pinjam

                                        </span>

                                        <span>

                                            {{ $book->tanggal_pinjam->format('d M Y') }}

                                        </span>

                                    </div>

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            Jatuh Tempo

                                        </span>

                                        <span>

                                            {{ $book->tgl_jatuh_tempo?->format('d M Y') ?? '-' }}

                                        </span>

                                    </div>

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            Dikembalikan

                                        </span>

                                        <span>

                                            {{ $book->tanggal_dikembalikan?->format('d M Y') ?? '-' }}

                                        </span>

                                    </div>

                                    <div class="flex justify-between">

                                        <span class="text-gray-500">

                                            Denda

                                        </span>

                                        <span class="text-red-500 font-semibold">

                                            Rp {{ number_format($book->denda, 0, ',', '.') }}

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- ===================================================== -->
                        <!-- DESKRIPSI -->
                        <!-- ===================================================== -->
                        <div class="mt-8">

                            <h3 class="font-semibold text-kombu mb-3">

                                Deskripsi Buku

                            </h3>

                            <p class="text-gray-600 leading-relaxed">

                                {{ $book->book->deskripsi ?? 'Tidak ada deskripsi.' }}

                            </p>

                        </div>


                        <!-- ===================================================== -->
                        <!-- BUTTON -->
                        <!-- ===================================================== -->
                        <div class="flex gap-4 mt-10">

                            <a href="{{ route('user.my-books.index') }}"
                                class="px-5 py-3 border border-gray-300 rounded-xl hover:bg-gray-100 transition">

                                Kembali

                            </a>

                            @if($book->status == 'dipinjam')

                                <a href="{{ route('user.my-books.return.form', $book->id) }}"
                                    class="px-5 py-3 bg-secondary text-white rounded-xl hover:bg-camel transition">

                                    Kembalikan Buku

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection