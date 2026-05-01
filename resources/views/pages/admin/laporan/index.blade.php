@extends('layouts.admin')

@section('content')

<div class="p-6 bg-background min-h-screen">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-primary">
            Laporan Peminjaman
        </h1>

        <button class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-camel flex items-center gap-2">
            📄 Ekspor Laporan
        </button>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-4">
        <div class="relative">
            <input type="text" name="search" placeholder="Cari Nama Anggota..."
                class="w-full border rounded-lg p-2 pr-10 focus:ring-secondary">
            <span class="absolute right-3 top-2">🔍</span>
        </div>
    </form>

    <!-- TABLE -->
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-sm">

            <!-- HEAD -->
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-3">Nama Peminjam</th>
                    <th class="p-3">Judul Buku</th>
                    <th class="p-3">Tgl Pinjam</th>
                    <th class="p-3">Tanggal Harus Kembali</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($data as $item)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">{{ $item['nama'] }}</td>
                    <td class="p-3">{{ $item['judul'] }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($item['tgl_pinjam'])->format('d M Y') }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($item['tgl_kembali'])->format('d M Y') }}</td>

                    <!-- STATUS -->
                    <td class="p-3 text-center">
                        @if($item['status'] == 'dipinjam')
                            <span class="bg-olivine text-white px-2 py-1 rounded-full text-xs">
                                Dipinjam
                            </span>
                        @elseif($item['status'] == 'kembali')
                            <span class="bg-asparagus text-white px-2 py-1 rounded-full text-xs">
                                Kembali
                            </span>
                        @else
                            <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                                Terlambat
                            </span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td class="p-3 text-center">
                        <a href="#" class="text-primary hover:underline">
                            Detail
                        </a>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">
                        Data tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

        <!-- PAGINATION (dummy) -->
        <div class="p-4 flex justify-between text-sm text-gray-500">
            <span>Menampilkan data</span>
            <div class="space-x-2">
                <button class="px-3 py-1 border rounded">Prev</button>
                <button class="px-3 py-1 bg-primary text-white rounded">1</button>
                <button class="px-3 py-1 border rounded">Next</button>
            </div>
        </div>

    </div>

</div>

@endsection