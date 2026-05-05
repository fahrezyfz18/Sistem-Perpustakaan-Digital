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

    <!-- STAT CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-kombu">
            <p class="text-gray-500 text-sm">Total Peminjaman</p>
            <h2 class="text-2xl font-bold text-kombu">
                {{ $totalPeminjaman ?? 0 }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-olivine">
            <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
            <h2 class="text-2xl font-bold text-olivine">
                {{ $dipinjam ?? 0 }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-mustard">
            <p class="text-gray-500 text-sm">Riwayat Selesai</p>
            <h2 class="text-2xl font-bold text-mustard">
                {{ $riwayat ?? 0 }}
            </h2>
        </div>

    </div>

    <!-- BUKU REKOMENDASI -->
    <div class="bg-white rounded-xl shadow p-5 mb-8">

        <h3 class="text-lg font-semibold text-kombu mb-4">
            Rekomendasi Buku
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            @forelse($rekomendasiBuku ?? [] as $buku)

                <div class="border rounded-lg p-4 hover:shadow transition">

                    <h4 class="font-semibold text-kombu">
                        {{ $buku->judul }}
                    </h4>

                    <p class="text-sm text-gray-500">
                        {{ $buku->penulis }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Stok: {{ $buku->stok }}
                    </p>

                </div>

            @empty

                <p class="text-gray-500 text-sm">
                    Tidak ada rekomendasi buku saat ini
                </p>

            @endforelse

        </div>

    </div>

    <!-- RIWAYAT PEMINJAMAN -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="bg-kombu text-white p-4 font-semibold">
            Riwayat Peminjaman
        </div>

        <table class="w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Judul Buku</th>
                    <th class="p-3 text-center">Tanggal Pinjam</th>
                    <th class="p-3 text-center">Tanggal Kembali</th>
                    <th class="p-3 text-center">Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($riwayatPeminjaman ?? [] as $item)

                    <tr class="border-b">

                        <td class="p-3">
                            {{ $item->buku }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $item->tgl_pinjam }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $item->tgl_kembali }}
                        </td>

                        <td class="p-3 text-center">

                            @if($item->status == 'dipinjam')
                                <span class="bg-mustard text-white px-2 py-1 rounded text-xs">
                                    Dipinjam
                                </span>
                            @else
                                <span class="bg-olivine text-white px-2 py-1 rounded text-xs">
                                    Selesai
                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center p-4 text-gray-500">
                            Belum ada riwayat peminjaman
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection