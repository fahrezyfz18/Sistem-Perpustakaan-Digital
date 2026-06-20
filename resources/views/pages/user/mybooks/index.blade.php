@extends('layouts.app')

@section('content')

    <div class="p-6 bg-background min-h-screen">

        <!-- HEADER -->
        <div class="mb-6">

            <h1 class="text-2xl font-semibold text-kombu">
                Buku Saya
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Buku yang sedang Anda pinjam dan pantau status pengembaliannya.
            </p>

        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="mb-4 bg-olivine text-white px-4 py-3 rounded-lg">

                {{ session('success') }}

            </div>

        @endif


        <!-- BOOK GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($books as $book)

                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">

                    <!-- COVER -->
                    <div class="h-64 overflow-hidden bg-gray-100">

                        @if($book->book && $book->book->cover)

                            <img src="{{ asset('storage/' . $book->book->cover) }}" class="w-full h-full object-cover">

                        @else

                            <div class="w-full h-full flex items-center justify-center text-gray-400">

                                No Cover

                            </div>

                        @endif

                    </div>


                    <!-- CONTENT -->
                    <div class="p-5">

                        <!-- JUDUL -->
                        <h3 class="font-semibold text-lg text-kombu line-clamp-1">

                            {{ $book->book->judul ?? '-' }}

                        </h3>


                        <!-- PENULIS -->
                        <p class="text-sm text-gray-500 mt-1">

                            {{ $book->book->penulis ?? '-' }}

                        </p>


                        <!-- TANGGAL -->
                        <div class="mt-4 space-y-1 text-sm text-gray-600">

                            <p>
                                <span class="font-medium">
                                    Dipinjam:
                                </span>

                                {{ \Carbon\Carbon::parse($book->tanggal_pinjam)->format('d M Y') }}
                            </p>

                            <p>
                                <span class="font-medium">
                                    Tgl Jatuh Tempo:
                                </span>

                                {{ $book->tgl_jatuh_tempo?->format('d M Y') ?? '-' }}
                            </p>

                        </div>


                        <!-- STATUS -->
                        <div class="mt-4">

                            @if($book->status == 'dipinjam')

                                <span class="bg-mustard text-white text-xs px-3 py-1 rounded-full">

                                    Sedang Dipinjam

                                </span>

                            @elseif($book->status == 'dikembalikan')

                                <span class="bg-olivine text-white text-xs px-3 py-1 rounded-full">

                                    Sudah Dikembalikan

                                </span>

                            @else

                                <span class="bg-gray-400 text-white text-xs px-3 py-1 rounded-full">

                                    Status Tidak Diketahui

                                </span>

                            @endif

                        </div>


                        <!-- BUTTON -->
                        <div class="mt-5 flex gap-3">

                            <!-- DETAIL -->
                            <a href="{{ route('user.my-books.detail', $book->id) }}"
                                class="flex-1 text-center bg-primary text-white py-2 rounded-lg hover:bg-accent transition text-sm">

                                Detail Buku

                            </a>


                            <!-- RETURN -->
                            @if($book->status == 'dipinjam')

    <span class="bg-mustard text-white px-3 py-1 rounded-full text-xs">
        Sedang Dipinjam
    </span>

    <a href="{{ route('user.my-books.return.form', $book->id) }}"
       class="bg-secondary text-white px-3 py-2 rounded-lg text-sm">
        Kembalikan
    </a>

@else

    <span class="bg-olivine text-white px-3 py-1 rounded-full text-xs">
        Sudah Dikembalikan
    </span>

@endif

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