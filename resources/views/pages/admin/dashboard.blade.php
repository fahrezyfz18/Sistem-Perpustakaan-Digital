@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-background p-4 sm:p-6">

```
<!-- HEADER -->
<div class="mb-6">

    <h1 class="text-xl sm:text-2xl md:text-3xl font-semibold text-kombu">
        Dashboard Admin
    </h1>

    <p class="text-sm text-gray-500 mt-1">
        Ringkasan Sistem Perpustakaan Digital
    </p>

    <!-- REALTIME CLOCK -->
    <div class="mt-3 bg-white inline-block px-3 sm:px-4 py-2 rounded-lg shadow border text-xs sm:text-sm text-gray-600">
        <span id="realtimeClock"></span>
    </div>

</div>

<script>
    function updateClock() {

        const now = new Date();

        const format = localStorage.getItem('dateFormat') || 'full';

        let optionsDate = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        };

        let date = now.toLocaleDateString('id-ID', optionsDate);
        let time = now.toLocaleTimeString('id-ID');

        let output = '';

        if (format === 'full') {
            output = `${date} • ${time}`;
        }

        if (format === 'short') {
            output = `${now.toLocaleDateString('id-ID')} • ${time}`;
        }

        if (format === 'time-only') {
            output = `${time}`;
        }

        document.getElementById('realtimeClock').innerHTML = output;
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>

<!-- STATISTIK -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-5 mb-8">

    <div class="bg-white p-5 rounded-xl shadow border-l-4 border-kombu">
        <p class="text-gray-500 text-sm">
            Total Buku
        </p>

        <h2 class="text-2xl font-bold text-kombu">
            {{ $stats['total_buku'] ?? 0 }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow border-l-4 border-olivine">
        <p class="text-gray-500 text-sm">
            Kategori
        </p>

        <h2 class="text-2xl font-bold text-olivine">
            {{ $stats['kategori'] ?? 0 }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow border-l-4 border-mustard">
        <p class="text-gray-500 text-sm">
            Anggota
        </p>

        <h2 class="text-2xl font-bold text-mustard">
            {{ $stats['anggota'] ?? 0 }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow border-l-4 border-secondary">
        <p class="text-gray-500 text-sm">
            Peminjaman Aktif
        </p>

        <h2 class="text-2xl font-bold text-secondary">
            {{ $stats['peminjaman'] ?? 0 }}
        </h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow border-l-4 border-red-500">
        <p class="text-gray-500 text-sm">
            Terlambat
        </p>

        <h2 class="text-2xl font-bold text-red-500">
            {{ $stats['terlambat'] ?? 0 }}
        </h2>
    </div>

</div>

<!-- TOP BOOK + PEMINJAMAN -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <!-- TOP BOOK -->
    <div class="bg-white p-5 rounded-xl shadow">

        <h3 class="text-lg font-semibold text-kombu mb-4">
            Top 3 Buku Terpopuler
        </h3>

        <ul class="space-y-3">

            @forelse($topBooks ?? [] as $book)

                <li class="flex justify-between border-b pb-2">

                    <span class="text-gray-700">
                        {{ $book->judul }}
                    </span>

                    <span class="font-semibold text-mustard">
                        {{ $book->total }}x
                    </span>

                </li>

            @empty

                <li class="text-gray-500">
                    Belum ada data buku populer.
                </li>

            @endforelse

        </ul>

    </div>

    <!-- PEMINJAMAN TERBARU -->
    <div class="bg-white p-5 rounded-xl shadow">

        <h3 class="text-lg font-semibold text-kombu mb-4">
            Peminjaman Terbaru
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="border-b">

                        <th class="text-left p-2">Kode</th>
                        <th class="text-left p-2">Anggota</th>
                        <th class="text-left p-2">Buku</th>
                        <th class="text-left p-2">Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($peminjamanTerbaru ?? [] as $item)

                        <tr class="border-b">

                            <td class="p-2">
                                {{ $item['kode'] }}
                            </td>

                            <td class="p-2">
                                {{ $item['anggota'] }}
                            </td>

                            <td class="p-2">
                                {{ $item['buku'] }}
                            </td>

                            <td class="p-2">

                                <span class="px-2 py-1 rounded bg-olivine text-white text-xs">

                                    {{ $item['status'] }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center p-4 text-gray-500">
                                Belum ada transaksi.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- QUICK MENU -->
<div class="bg-white p-5 rounded-xl shadow">

    <h3 class="text-lg font-semibold text-kombu mb-4">
        Menu Cepat
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <a href="{{ route('admin.buku.index') }}"
            class="bg-kombu text-white p-4 rounded-xl text-center shadow hover:opacity-90">
            Buku
        </a>

        <a href="{{ route('admin.anggota.index') }}"
            class="bg-olivine text-white p-4 rounded-xl text-center shadow hover:opacity-90">
            Anggota
        </a>

        <a href="{{ route('admin.transaksi.index') }}"
            class="bg-mustard text-white p-4 rounded-xl text-center shadow hover:opacity-90">
            Transaksi
        </a>

        <a href="{{ route('admin.laporan.peminjaman') }}"
            class="bg-asparagus text-white p-4 rounded-xl text-center shadow hover:opacity-90">
            Laporan
        </a>

    </div>

</div>
```

</div>

@endsection
