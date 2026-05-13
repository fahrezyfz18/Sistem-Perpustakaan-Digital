@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-background p-6">

        <div class="max-w-6xl mx-auto">

            <!-- CARD -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">

                    <!-- COVER -->
                    <div class="bg-gray-100 flex items-center justify-center p-6">

                        @if($book->book && $book->book->cover)

                            <img src="{{ asset('storage/' . $book->book->cover) }}"
                                class="rounded-xl w-full max-w-xs object-cover shadow-md">

                        @else

                            <div class="h-96 w-full flex items-center justify-center text-gray-400">

                                No Cover

                            </div>

                        @endif

                    </div>


                    <!-- DETAIL -->
                    <div class="md:col-span-2 p-8">

                        <!-- JUDUL -->
                        <h1 class="text-3xl font-bold text-kombu">

                            {{ $book->book->judul ?? '-' }}

                        </h1>


                        <!-- PENULIS -->
                        <p class="text-gray-500 mt-2">

                            {{ $book->book->penulis ?? '-' }}

                        </p>


                        <!-- STATUS -->
                        <div class="mt-5">

                            @if($book->status == 'dipinjam')

                                <span class="bg-mustard text-white text-xs px-4 py-2 rounded-full">

                                    Sedang Dipinjam

                                </span>

                            @elseif($book->status == 'dikembalikan')

                                <span class="bg-olivine text-white text-xs px-4 py-2 rounded-full">

                                    Sudah Dikembalikan

                                </span>

                            @endif

                        </div>


                        <!-- INFORMASI -->
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- INFORMASI BUKU -->
                            <div>

                                <h3 class="font-semibold text-kombu mb-3">

                                    Informasi Buku

                                </h3>

                                <div class="space-y-2 text-sm text-gray-600">

                                    <p>
                                        <span class="font-medium">
                                            ISBN:
                                        </span>

                                        {{ $book->book->isbn ?? '-' }}
                                    </p>

                                    <p>
                                        <span class="font-medium">
                                            Penerbit:
                                        </span>

                                        {{ $book->book->penerbit ?? '-' }}
                                    </p>

                                    <p>
                                        <span class="font-medium">
                                            Kategori:
                                        </span>

                                        {{ $book->book->kategori ?? '-' }}
                                    </p>

                                    <p>
                                        <span class="font-medium">
                                            Tahun:
                                        </span>

                                        {{ $book->book->tahun ?? '-' }}
                                    </p>

                                </div>

                            </div>


                            <!-- INFORMASI PEMINJAMAN -->
                            <div>

                                <h3 class="font-semibold text-kombu mb-3">

                                    Informasi Peminjaman

                                </h3>

                                <div class="space-y-2 text-sm text-gray-600">

                                    <!-- TANGGAL PINJAM -->
                                    <p>

                                        <span class="font-medium">

                                            Tanggal Pinjam:

                                        </span>

                                        {{ \Carbon\Carbon::parse($book->tanggal_pinjam)->format('d M Y') }}

                                    </p>


                                    <!-- DEADLINE -->
                                    <p>

                                        <span class="font-medium">

                                            Deadline Pengembalian:

                                        </span>

                                        @if($book->deadline)

                                            {{ \Carbon\Carbon::parse($book->deadline)->format('d M Y') }}

                                        @else

                                            -

                                        @endif

                                    </p>


                                    <!-- TANGGAL DIKEMBALIKAN -->
                                    <p>

                                        <span class="font-medium">

                                            Tanggal Dikembalikan:

                                        </span>

                                        @if($book->tanggal_dikembalikan)

                                            {{ \Carbon\Carbon::parse($book->tanggal_dikembalikan)->format('d M Y') }}

                                        @else

                                            Belum dikembalikan

                                        @endif

                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- DESKRIPSI -->
                        <div class="mt-8">

                            <h3 class="font-semibold text-kombu mb-3">

                                Deskripsi Buku

                            </h3>

                            <p class="text-sm leading-relaxed text-gray-600">

                                {{ $book->book->deskripsi ?? 'Tidak ada deskripsi.' }}

                            </p>

                        </div>


                        <!-- ACTION -->
                        <div class="mt-8 flex gap-4">

                            <!-- KEMBALI -->
                            <a href="{{ route('user.my-books.index') }}"
                                class="px-5 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">

                                Kembali

                            </a>


                            <!-- KEMBALIKAN -->
                            @if($book->status == 'dipinjam')

                                <a href="{{ route('user.my-books.return.form', $book->id) }}"
                                    class="px-5 py-2 bg-secondary text-white rounded-lg hover:bg-camel transition">

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