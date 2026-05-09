@extends('layouts.app')

@section('content')

<div class="p-6 bg-background min-h-screen">

    <!-- PAGE HEADER -->
    <div class="mb-6">

        <h1 class="text-2xl md:text-3xl font-semibold text-kombu tracking-tight">
            Dashboard
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Ringkasan aktivitas peminjaman dan rekomendasi buku untuk Anda
        </p>

    </div>


    <!-- SEARCH -->
    <div class="bg-white rounded-xl shadow p-4 mb-6">

        <form
            action="{{ route('user.books.index') }}"
            method="GET"
            class="grid grid-cols-1 md:grid-cols-4 gap-3">

            <!-- SEARCH INPUT -->
            <div class="md:col-span-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari buku..."
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-primary outline-none">

            </div>

            <!-- CATEGORY -->
            <div>

                <select
                    name="kategori"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-primary outline-none">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($categories ?? [] as $kategori)

                        <option
                            value="{{ $kategori }}"
                            {{ request('kategori') == $kategori ? 'selected' : '' }}>

                            {{ $kategori }}

                        </option>

                    @endforeach

                </select>

            </div>

        </form>

    </div>


    <!-- STATISTICS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <!-- TOTAL PEMINJAMAN -->
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-kombu">

            <p class="text-gray-500 text-sm">
                Total Peminjaman
            </p>

            <h2 class="text-3xl font-bold text-kombu mt-2">
                {{ $totalPeminjaman ?? 0 }}
            </h2>

        </div>


        <!-- SEDANG DIPINJAM -->
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-olivine">

            <p class="text-gray-500 text-sm">
                Sedang Dipinjam
            </p>

            <h2 class="text-3xl font-bold text-olivine mt-2">
                {{ $dipinjam ?? 0 }}
            </h2>

        </div>


        <!-- RIWAYAT -->
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-mustard">

            <p class="text-gray-500 text-sm">
                Riwayat Selesai
            </p>

            <h2 class="text-3xl font-bold text-mustard mt-2">
                {{ $riwayat ?? 0 }}
            </h2>

        </div>

    </div>


    <!-- REKOMENDASI BUKU -->
    <div class="bg-white rounded-xl shadow p-5 mb-8">

        <div class="flex items-center justify-between mb-5">

            <div>

                <h3 class="text-lg font-semibold text-kombu">
                    Rekomendasi Buku
                </h3>

                <p class="text-sm text-gray-500">
                    Buku terbaru yang tersedia di perpustakaan
                </p>

            </div>

            <a href="{{ route('user.books.index') }}"
               class="text-sm text-primary hover:underline">

                Lihat Semua

            </a>

        </div>


        <!-- BOOK GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            @forelse($rekomendasiBuku ?? [] as $buku)

                <div class="bg-white border rounded-xl overflow-hidden
                            hover:shadow-lg transition duration-300">

                    <!-- COVER -->
                    <img
                        src="{{ $buku->cover
                            ? asset('storage/' . $buku->cover)
                            : asset('images/no-cover.png') }}"
                        alt="{{ $buku->judul }}"
                        class="w-full h-60 object-cover">

                    <!-- CONTENT -->
                    <div class="p-4">

                        <h4 class="font-semibold text-kombu text-lg line-clamp-1">
                            {{ $buku->judul }}
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $buku->penulis }}
                        </p>

                        <div class="flex items-center justify-between mt-3">

                            <span class="bg-kombu/10 text-kombu
                                         text-xs px-3 py-1 rounded-full">

                                {{ $buku->kategori }}

                            </span>

                            <span class="text-xs text-gray-400">
                                Stok: {{ $buku->stok }}
                            </span>

                        </div>

                        <!-- BUTTON -->
                        <div class="mt-5">

                            <a href="{{ route('user.books.show', $buku->id) }}"
                               class="w-full inline-flex justify-center items-center
                                      bg-primary text-white px-4 py-2 rounded-lg
                                      hover:bg-accent transition">

                                Detail Buku

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center py-10">

                    <p class="text-gray-500">
                        Tidak ada rekomendasi buku saat ini
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    <!-- RIWAYAT PEMINJAMAN -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <!-- HEADER -->
        <div class="bg-kombu text-white p-4">

            <h3 class="font-semibold">
                Riwayat Peminjaman
            </h3>

        </div>


        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">
                            Judul Buku
                        </th>

                        <th class="p-4 text-center">
                            Tanggal Pinjam
                        </th>

                        <th class="p-4 text-center">
                            Tanggal Kembali
                        </th>

                        <th class="p-4 text-center">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($riwayatPeminjaman ?? [] as $item)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- JUDUL -->
                            <td class="p-4">

                                {{ $item->buku->judul ?? '-' }}

                            </td>


                            <!-- TGL PINJAM -->
                            <td class="p-4 text-center">

                                {{ $item->tgl_pinjam ?? '-' }}

                            </td>


                            <!-- TGL KEMBALI -->
                            <td class="p-4 text-center">

                                {{ $item->tgl_kembali ?? '-' }}

                            </td>


                            <!-- STATUS -->
                            <td class="p-4 text-center">

                                @if($item->status == 'dipinjam')

                                    <span class="bg-mustard/20 text-mustard
                                                 px-3 py-1 rounded-full
                                                 text-xs font-medium">

                                        Dipinjam

                                    </span>

                                @elseif($item->status == 'dikembalikan')

                                    <span class="bg-olivine/20 text-olivine
                                                 px-3 py-1 rounded-full
                                                 text-xs font-medium">

                                        Selesai

                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-500
                                                 px-3 py-1 rounded-full
                                                 text-xs font-medium">

                                        Terlambat

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4">

                                <div class="flex flex-col items-center justify-center py-10">

                                    <p class="text-gray-500 text-sm">
                                        Belum ada riwayat peminjaman
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection