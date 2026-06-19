@extends('layouts.admin')

@section('content')

<x-page
    title="Transaksi Peminjaman & Pengembalian"
    subtitle="Monitoring aktivitas peminjaman dan pengembalian buku">

    <!-- SEARCH -->
    <div class="mb-4">
        <x-search-filter
            :action="route('admin.transaksi.index')"
            placeholder="Cari nama anggota atau buku..." />
    </div>

    <!-- TABLE -->
    <x-table
        :headers="[
            'Nama',
            'Buku',
            'Tanggal Pinjam',
            'Jatuh Tempo',
            'Status',
            'Denda',
            'Aksi'
        ]">

        @forelse($transaksi as $item)

            <x-table-row>

                <x-table-cell>
                    {{ $item['nama'] }}
                </x-table-cell>

                <x-table-cell>
                    {{ $item['buku'] }}
                </x-table-cell>

                <x-table-cell>
                    {{ \Carbon\Carbon::parse($item['tgl_pinjam'])->translatedFormat('d F Y') }}
                </x-table-cell>

                <x-table-cell>
                    {{ \Carbon\Carbon::parse($item['jatuh_tempo'])->translatedFormat('d F Y') }}
                </x-table-cell>

                <x-table-cell>

                    @if($item['status'] == 'Dipinjam')

                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Dipinjam
                        </span>

                    @elseif($item['status'] == 'Dikembalikan')

                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Dikembalikan
                        </span>

                    @else

                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Terlambat
                        </span>

                    @endif

                </x-table-cell>

                <x-table-cell>

                    @if($item['denda'] > 0)

                        <span class="text-red-600 font-semibold">
                            Rp {{ number_format($item['denda'], 0, ',', '.') }}
                        </span>

                    @else

                        <span class="text-gray-400">
                            -
                        </span>

                    @endif

                </x-table-cell>

                <x-table-cell>

                    <div class="flex justify-center gap-2">

                        <button
                            type="button"
                            class="px-3 py-2 bg-blue-100 text-blue-600 rounded-lg text-sm">
                            Detail
                        </button>

                    </div>

                </x-table-cell>

            </x-table-row>

        @empty

            <tr>
                <td colspan="7" class="text-center p-6 text-gray-500">
                    Data transaksi tidak ditemukan
                </td>
            </tr>

        @endforelse

    </x-table>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $transaksi->links() }}
    </div>

</x-page>

@endsection