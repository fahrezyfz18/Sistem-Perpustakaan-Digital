@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-100 p-6">

        <div class="mb-6">
            <h1 class="text-4xl font-bold text-green-900">
                Transaksi Peminjaman & Pengembalian
            </h1>

            <p class="text-gray-500 mt-2">
                Monitoring aktivitas peminjaman dan pengembalian buku
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-200">

            <!-- Search -->
            <form method="GET" id="searchForm" class="mb-6">

                <div class="relative">

                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>

                    <input type="search" name="search" value="{{ request('search') }}" autocomplete="off"
                        placeholder="Cari Nama Anggota atau Nama Buku..."
                        class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-xl bg-gray-50 focus:ring-green-500 focus:border-green-500">

                </div>

            </form>

            <!-- Table -->
            <div class="overflow-x-auto rounded-xl border border-gray-200">

                <table class="w-full text-sm text-center text-gray-600">

                    <thead class="text-sm text-white uppercase bg-green-900 text-center">
                        <tr>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Buku</th>
                            <th class="px-6 py-4">Tanggal Pinjam</th>
                            <th class="px-6 py-4">Tanggal Dikembalikan</th>
                            <th class="px-6 py-4">Jatuh Tempo</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Denda</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($transaksi as $item)

                            <tr class="bg-white border-b hover:bg-gray-50 transition">

<td class="px-6 py-4 text-center align-middle font-semibold text-gray-900">
    {{ $item->user->name }}
</td>

<td class="px-6 py-4 text-center align-middle">
    {{ $item->book->judul }}
</td>

                                <td class="px-6 py-4 text-center align-middle">
                                    {{ $item->tanggal_pinjam?->translatedFormat('d F Y') ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center align-middle">

                                    @if($item->tanggal_dikembalikan)

                                        {{ $item->tanggal_dikembalikan->translatedFormat('d F Y') }}

                                    @else

                                        <span class="text-gray-400">-</span>

                                    @endif

                                </td>

<td class="px-6 py-4 text-center align-middle">

    @if($item->deadline)

        {{ $item->deadline->translatedFormat('d F Y') }}

    @else

        <span class="text-gray-400">-</span>

    @endif

</td>

<td class="px-6 py-4 text-center align-middle">

    @if($item->status == 'dikembalikan')

        <span class="bg-green-100 text-green-700 text-xs font-semibold px-4 py-2 rounded-full">
            Dikembalikan
        </span>

    @elseif($item->deadline && now()->gt($item->deadline))

        <span class="bg-red-100 text-red-700 text-xs font-semibold px-4 py-2 rounded-full">
            Terlambat
        </span>

    @else

        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-4 py-2 rounded-full">
            Dipinjam
        </span>

    @endif

</td>
<td class="px-6 py-4 text-center align-middle font-semibold">

    @if($item->denda > 0)

        <span class="text-red-600">
            Rp {{ number_format($item->denda, 0, ',', '.') }}
        </span>

    @else

        <span class="text-gray-400">
            -
        </span>

    @endif

</td>

                                <td class="px-6 py-4 text-center align-middle">

                                    <a href="#"
                                        class="inline-flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                        Detail
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="px-6 py-6 text-center text-gray-500">
                                    Data transaksi tidak ditemukan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $transaksi->links() }}
            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.querySelector('input[name="search"]');

            if (searchInput) {

                searchInput.addEventListener('keyup', function () {

                    clearTimeout(window.searchTimer);

                    window.searchTimer = setTimeout(() => {

                        document.getElementById('searchForm').submit();

                    }, 300);

                });

            }

        });
    </script>

@endsection