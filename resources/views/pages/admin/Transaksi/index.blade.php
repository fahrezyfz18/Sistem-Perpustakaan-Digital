@extends('layouts.admin')

@section('content')

<div class="p-6 bg-background min-h-screen">

    <!-- HEADER -->
    <h1 class="text-2xl font-semibold text-primary mb-6">
        Transaksi Peminjaman & Pengembalian
    </h1>

    <!-- SEARCH -->
    <div class="mb-6">
        <div class="relative">
            <input type="text" id="search"
                placeholder="Cari Nama Anggota..."
                class="w-full border rounded-lg py-2 pl-10 pr-4 
                       focus:ring-2 focus:ring-secondary focus:border-secondary
                       outline-none transition">

            <!-- ICON -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-sm text-center">

            <!-- HEAD -->
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-3">Nama Peminjam</th>
                    <th class="p-3">Judul Buku</th>
                    <th class="p-3">Tanggal Pinjam</th>
                    <th class="p-3">Tanggal Harus Kembali</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                    <th class="p-3">Denda</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody id="table-body">
                @forelse($data as $item)

                <tr class="border-b hover:bg-gray-50 
                    {{ $item->status == 'terlambat' ? 'bg-red-50' : '' }}">

                    <td class="p-3">{{ $item->nama }}</td>
                    <td class="p-3">{{ $item->judul }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}</td>

                    <!-- STATUS -->
                    <td class="p-3">
                        @if($item->status == 'dipinjam')
                            <span class="bg-olivine text-white px-3 py-1 rounded-full text-xs">
                                Dipinjam
                            </span>

                        @elseif($item->status == 'kembali')
                            <span class="bg-asparagus text-white px-3 py-1 rounded-full text-xs">
                                Kembali
                            </span>

                        @else
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs">
                                Terlambat
                            </span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td class="p-3">
                        <a href="{{ route('admin.transaksi.detail', $item->id) }}"
                           class="text-primary hover:underline">
                            Detail
                        </a>
                    </td>

                    <!-- DENDA -->
                    <td class="p-3">
                        @if(isset($item->denda) && $item->denda > 0)
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm font-semibold">
                                Rp {{ number_format($item->denda, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center p-4 text-gray-500">
                        Data tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

        <!-- PAGINATION -->
        <div class="p-4 flex justify-between items-center text-sm">

            <span class="text-gray-500">
                Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
            </span>

            <div class="space-x-2">

                <!-- PREV -->
                @if ($data->onFirstPage())
                    <span class="px-3 py-1 border rounded text-gray-400">Prev</span>
                @else
                    <a href="{{ $data->previousPageUrl() }}"
                       class="px-3 py-1 border rounded hover:bg-gray-100">
                        Prev
                    </a>
                @endif

                <!-- CURRENT -->
                <span class="px-3 py-1 bg-primary text-white rounded">
                    {{ $data->currentPage() }}
                </span>

                <!-- NEXT -->
                @if ($data->hasMorePages())
                    <a href="{{ $data->nextPageUrl() }}"
                       class="px-3 py-1 border rounded hover:bg-gray-100">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1 border rounded text-gray-400">Next</span>
                @endif

            </div>
        </div>

    </div>

</div>

<!-- 🔥 REALTIME SEARCH -->
<script>
let timeout = null;

document.getElementById('search').addEventListener('keyup', function () {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        let keyword = this.value;

        fetch(`/admin/transaksi?search=${keyword}`)
            .then(response => response.text())
            .then(html => {
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');

                document.getElementById('table-body').innerHTML =
                    doc.querySelector('#table-body').innerHTML;
            });
    }, 300);
});
</script>

@endsection