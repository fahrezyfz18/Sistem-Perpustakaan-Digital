@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-background p-4 sm:p-6">

        <!-- HEADER -->
        <div class="mb-6">

            <h1 class="text-xl sm:text-2xl md:text-3xl font-semibold text-kombu">
                Dashboard Admin
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Ringkasan sistem perpustakaan
            </p>

            <!-- REALTIME CLOCK -->
            <div
                class="mt-3 bg-white inline-block px-3 sm:px-4 py-2 rounded-lg shadow border text-xs sm:text-sm text-gray-600">
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

        <!-- STAT -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">

            <div class="bg-white p-4 sm:p-5 rounded-xl shadow border-l-4 border-kombu">
                <p class="text-gray-500 text-sm">Total Buku</p>
                <h2 class="text-xl sm:text-2xl font-bold text-kombu">{{ $stats['total_buku'] ?? 0 }}</h2>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-xl shadow border-l-4 border-olivine">
                <p class="text-gray-500 text-sm">Kategori</p>
                <h2 class="text-xl sm:text-2xl font-bold text-olivine">{{ $stats['kategori'] ?? 0 }}</h2>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-xl shadow border-l-4 border-mustard">
                <p class="text-gray-500 text-sm">Anggota</p>
                <h2 class="text-xl sm:text-2xl font-bold text-mustard">{{ $stats['anggota'] ?? 0 }}</h2>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-xl shadow border-l-4 border-secondary">
                <p class="text-gray-500 text-sm">Peminjaman Aktif</p>
                <h2 class="text-xl sm:text-2xl font-bold text-secondary">{{ $stats['peminjaman'] ?? 0 }}</h2>
            </div>

        </div>

        <!-- CHART + TOP -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6 mb-8">

            <div class="bg-white p-4 sm:p-5 rounded-xl shadow lg:col-span-2 overflow-x-auto">
                <h3 class="text-base sm:text-lg font-semibold text-kombu mb-4">
                    Grafik Peminjaman
                </h3>
                <canvas id="chartPeminjaman"></canvas>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-xl shadow">
                <h3 class="text-base sm:text-lg font-semibold text-kombu mb-4">
                    Top 3 Buku
                </h3>

                <ul class="space-y-2 text-sm">
                    @forelse($topBooks ?? [] as $book)
                        <li class="flex justify-between border-b pb-1">
                            <span class="truncate">{{ $book->judul }}</span>
                            <span class="text-gray-500">{{ $book->total }}x</span>
                        </li>
                    @empty
                        <p class="text-gray-500">Tidak ada data</p>
                    @endforelse
                </ul>
            </div>

        </div>

    </div>

@endsection