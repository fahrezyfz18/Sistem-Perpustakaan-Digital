@extends('layouts.app')

@section('content')

    <div class="p-6 bg-background min-h-screen">

        <!-- ==========================================
                 PAGE HEADER
            =========================================== -->
        <div class="mb-8">

            <h1 class="text-2xl md:text-3xl font-extrabold text-kombu tracking-tight">
                Buku Saya
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Buku yang sedang Anda pinjam dan pantau status pengembaliannya.
            </p>

        </div>

        <!-- ==========================================
                 SUCCESS MESSAGE
            =========================================== -->
        @if (session('success'))

            <div
                class="mb-6 bg-olivine/10 border border-olivine text-olivine px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1
                                     1 0 00-1.414-1.414L9 10.586 7.707
                                     9.293a1 1 0 00-1.414 1.414l2
                                     2a1 1 0 001.414 0l4-4z" />

                </svg>

                {{ session('success') }}

            </div>

        @endif

        <!-- ==========================================
     FILTER STATUS
========================================== -->

<div class="flex flex-wrap items-center gap-3 mb-6">

    <a href="{{ route('user.my-books.index') }}"
       class="px-4 py-2 rounded-xl text-sm font-medium transition
       {{ request('status') == null
            ? 'bg-primary text-white'
            : 'bg-white border border-gray-300 hover:bg-gray-50' }}">
        Semua
        <span class="ml-1 bg-white/20 px-2 py-0.5 rounded">
            {{ $jumlahDipinjam + $jumlahDikembalikan }}
        </span>
    </a>

    <a href="{{ route('user.my-books.index', ['status' => 'dipinjam']) }}"
       class="px-4 py-2 rounded-xl text-sm font-medium transition
       {{ request('status') == 'dipinjam'
            ? 'bg-mustard text-white'
            : 'bg-white border border-gray-300 hover:bg-gray-50' }}">
        Sedang Dipinjam
        <span class="ml-1 bg-white/20 px-2 py-0.5 rounded">
            {{ $jumlahDipinjam }}
        </span>
    </a>

    <a href="{{ route('user.my-books.index', ['status' => 'dikembalikan']) }}"
       class="px-4 py-2 rounded-xl text-sm font-medium transition
       {{ request('status') == 'dikembalikan'
            ? 'bg-olivine text-white'
            : 'bg-white border border-gray-300 hover:bg-gray-50' }}">
        Sudah Dikembalikan
        <span class="ml-1 bg-white/20 px-2 py-0.5 rounded">
            {{ $jumlahDikembalikan }}
        </span>
    </a>

</div>

    <div class="mb-6">

    @switch(request('status'))

        @case('dipinjam')

            <p class="text-sm text-gray-500">
                Menampilkan buku yang sedang dipinjam.
            </p>

            @break

        @case('dikembalikan')

            <p class="text-sm text-gray-500">
                Menampilkan riwayat buku yang telah dikembalikan.
            </p>

            @break

        @default

            <p class="text-sm text-gray-500">
                Menampilkan seluruh riwayat peminjaman Anda.
            </p>

    @endswitch

</div>

            <!-- ==========================================
         BOOK LIST
    =========================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse ($books as $book)

                    <!-- Book Card -->
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden
                                hover:shadow-md hover:-translate-y-1 transition-all duration-300
                                flex flex-col h-full">

                        <!-- Book Cover -->
                        <div class="w-full aspect-[3/4] overflow-hidden bg-gray-50 relative border-b border-gray-50">

                            @if ($book->book && $book->book->cover)

                                <img
                                    src="{{ asset('storage/' . $book->book->cover) }}"
                                    alt="{{ $book->book->judul }}"
                                    class="w-full h-full object-cover
                                           group-hover:scale-105
                                           transition-transform duration-500"
                                >

                            @else

                                <!-- Default Cover -->
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 gap-2 p-4">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-10 w-10 stroke-1"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M12 6.253v13m0-13C10.832
                                               5.477 9.246 5 7.5 5S4.168
                                               5.477 3 6.253v13C4.168
                                               18.477 5.754 18 7.5
                                               18s3.332.477 4.5
                                               1.253m0-13C13.168
                                               5.477 14.754 5
                                               16.5 5c1.747 0
                                               3.332.477 4.5
                                               1.253v13C19.832
                                               18.477 18.247
                                               18 16.5 18c-1.746
                                               0-3.332.477-4.5
                                               1.253"
                                        />

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

                                <!-- Borrow Status -->
                                <div class="mb-3">

                                    @if ($book->status == 'dipinjam')

                                        <span class="inline-flex items-center bg-mustard/10 text-mustard text-xs font-semibold px-2 py-1 rounded-md tracking-wide">

                                            <span class="w-1.5 h-1.5 bg-mustard rounded-full mr-1.5 animate-pulse"></span>

                                            Sedang Dipinjam

                                        </span>

                                    @elseif ($book->status == 'dikembalikan')

                                        <span class="inline-flex items-center bg-olivine/10 text-olivine text-xs font-semibold px-2.5 py-1 rounded-md tracking-wide">

                                            <span class="w-1.5 h-1.5 bg-olivine rounded-full mr-1.5"></span>

                                            Sudah Dikembalikan

                                        </span>

                                    @else

                                        <span class="inline-flex items-center bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-md tracking-wide">

                                            Status Tidak Diketahui

                                        </span>

                                    @endif

                                </div>

                                <!-- Book Title -->
                                <h3
                                    class="font-bold text-sm md:text-base text-kombu
                                           line-clamp-2 leading-snug
                                           group-hover:text-primary
                                           transition-colors duration-300"
                                    title="{{ $book->book->judul ?? '-' }}"
                                >
                                    {{ $book->book->judul ?? '-' }}
                                </h3>

                                <!-- Book Author -->
                                <p class="text-sm text-gray-500 mt-1 line-clamp-1">
                                    {{ $book->book->penulis ?? '-' }}
                                </p>

                                <!-- Borrow Information -->
                                <div class="mt-4 pt-4 border-t border-gray-50 space-y-2 text-xs text-gray-600">

                                    <div class="flex justify-between items-center">

                                        <span class="text-gray-400">
                                            Tanggal Pinjam
                                        </span>

                                        <span class="font-medium text-gray-700">
                                            {{ \Carbon\Carbon::parse($book->tanggal_pinjam)->format('d M Y') }}
                                        </span>

                                    </div>

                                    <div class="flex justify-between items-center">

                                        <span class="text-gray-400">
                                            Jatuh Tempo
                                        </span>

                                        <span class="font-semibold text-gray-700">
                                            {{ $book->tgl_jatuh_tempo?->format('d M Y') ?? '-' }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-6 flex items-center gap-3">

                                <!-- Detail Button -->
                                <a
                                    href="{{ route('user.my-books.detail', $book->id) }}"
                                    class="flex-1 text-center bg-primary text-white
                                           font-semibold py-2.5 px-4 rounded-xl
                                           hover:bg-accent transition-colors
                                           duration-300 text-sm shadow-sm hover:shadow"
                                >
                                    Detail Buku
                                </a>

                                <!-- Return Button -->
                                @if ($book->status == 'dipinjam')

                                    <a
                                        href="{{ route('user.my-books.return.form', $book->id) }}"
                                        class="flex-1 text-center bg-secondary text-white
                                               font-semibold py-2.5 px-4 rounded-xl
                                               hover:opacity-90 transition-opacity
                                               duration-300 text-sm shadow-sm"
                                    >
                                        Kembalikan
                                    </a>

                                @else

                                    <button
                                        disabled
                                        class="flex-1 text-center bg-gray-100 text-gray-400
                                               font-medium py-2.5 px-4 rounded-xl
                                               text-sm cursor-not-allowed"
                                    >
                                        Selesai
                                    </button>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm text-gray-400">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-12 w-12 mx-auto stroke-1 text-gray-300 mb-3"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832
                                   5.477 9.246 5 7.5S4.168
                                   5.477 3 6.253v13C4.168
                                   18.477 5.754 18 7.5
                                   18s3.332.477 4.5
                                   1.253m0-13C13.168
                                   5.477 14.754 5
                                   16.5 5c1.747 0
                                   3.332.477 4.5
                                   1.253v13C19.832
                                   18.477 18.247
                                   18 16.5 18c-1.746
                                   0-3.332.477-4.5
                                   1.253"
                            />

                        </svg>

                        <p class="text-base font-medium text-gray-500">
                            Anda belum meminjam buku
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Silakan menuju ke menu daftar buku untuk melakukan peminjaman.
                        </p>

                    </div>

                @endforelse

                @if($books->hasPages())

    <div class="mt-10">

        {{ $books->links() }}

    </div>

@endif

            </div>

        </div>

@endsection