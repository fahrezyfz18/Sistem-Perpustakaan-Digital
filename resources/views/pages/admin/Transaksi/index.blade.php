@extends('layouts.admin')

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

            <form method="GET" class="mb-6">

                <div class="relative">

                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>

                    <input type="search" name="search" value="{{ request('search') }}"
                        class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-xl bg-gray-50 focus:ring-green-500 focus:border-green-500"
                        placeholder="Cari Nama Anggota atau Buku...">
                </div>
            </form>
            <div class="overflow-x-auto rounded-xl border border-gray-200">

                <table class="w-full text-sm text-left text-gray-500">

                    <thead class="text-sm text-white uppercase bg-green-900">
                        <tr>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Buku</th>
                            <th class="px-6 py-4">Tanggal Pinjam</th>
                            <th class="px-6 py-4">Jatuh Tempo</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Denda</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transaksi as $item)

                            <tr class="bg-white border-b hover:bg-gray-50 transition duration-200">

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $item['nama'] }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $item['buku'] }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($item['tgl_pinjam'])->translatedFormat('d F Y') }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($item['jatuh_tempo'])->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4">

                                    @if($item['status'] == 'Dipinjam')

                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-4 py-2 rounded-full">
                                            Dipinjam
                                        </span>

                                    @elseif($item['status'] == 'Dikembalikan')

                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-4 py-2 rounded-full">
                                            Dikembalikan
                                        </span>

                    @else

                                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-4 py-2 rounded-full">
                                            Terlambat
                                        </span>

                                    @endif
                                </td>

                                <td class="px-6 py-4 font-semibold">

                                    @if($item['denda'] > 0)

                                        <span class="text-red-600">
                                            Rp {{ number_format($item['denda'], 0, ',', '.') }}
                                        </span>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>
                                <td class="px-6 py-4">

                                    <button type="button"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 transition duration-200">
                                        Detail
                                    </button>
                                </td>
                            </tr>

        @empty

                            <tr>
                                <td colspan="7" class="px-6 py-6 text-center text-gray-500">
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

@endsection