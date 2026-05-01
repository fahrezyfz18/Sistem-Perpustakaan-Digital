@extends('layouts.admin')

@section('content')

    <div class="bg-olivine text-white p-4 rounded mb-6 shadow">
        Selamat datang, Admin 👋
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-primary text-white p-4 rounded shadow">
            <p>Total Buku</p>
            <h2 class="text-2xl font-bold">{{ $stats['total_buku'] ?? 0 }}</h2>
        </div>

        <div class="bg-asparagus text-white p-4 rounded shadow">
            <p>Kategori</p>
            <h2 class="text-2xl font-bold">{{ $stats['kategori'] ?? 0 }}</h2>
        </div>

        <div class="bg-camel text-white p-4 rounded shadow">
            <p>Anggota</p>
            <h2 class="text-2xl font-bold">{{ $stats['anggota'] ?? 0 }}</h2>
        </div>

        <div class="bg-secondary text-white p-4 rounded shadow">
            <p>Peminjaman Aktif</p>
            <h2 class="text-2xl font-bold">{{ $stats['peminjaman'] ?? 0 }}</h2>
        </div>

    </div> <!-- TABEL PEMINJAMAN -->
    <div class="bg-white rounded shadow">
        <div class="bg-primary text-white p-3 rounded-t"> Peminjaman Terbaru </div>
        <div class="p-4 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Kode</th>
                        <th class="p-2">Anggota</th>
                        <th class="p-2">Buku</th>
                        <th class="p-2">Tgl Pinjam</th>
                        <th class="p-2">Tgl Kembali</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody> @forelse ($peminjamanTerbaru ?? [] as $item) <tr class="border-b">
                    <td class="p-2">{{ $item['kode'] }}</td>
                    <td class="p-2">{{ $item['anggota'] }}</td>
                    <td class="p-2">{{ $item['buku'] }}</td>
                    <td class="p-2">{{ $item['tgl_pinjam'] }}</td>
                    <td class="p-2">{{ $item['tgl_kembali'] }}</td>
                    <td class="p-2"> @if($item['status'] == 'Dikembalikan') <span
                    class="bg-green-500 text-white px-2 py-1 rounded text-xs"> Dikembalikan </span> @else <span
                            class="bg-yellow-500 text-white px-2 py-1 rounded text-xs"> Dipinjam </span> @endif </td>
                </tr> @empty <tr>
                        <td colspan="6" class="text-center p-4"> Tidak ada data </td>
                    </tr> @endforelse </tbody>
            </table>

        </div>

@endsection