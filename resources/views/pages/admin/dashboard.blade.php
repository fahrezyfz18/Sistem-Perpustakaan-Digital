@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-background p-4 sm:p-6 space-y-6">

        <!-- Header Dashboard -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- ... (sebagian kode tetap sama) ... -->
            <div>
                <h1 class="text-4xl font-bold text-kombu tracking-tight">Dashboard Admin</h1>
                <p class="text-sm text-gray-500 mt-1">Ringkasan aktivitas, kendali sirkulasi, dan analisis data perpustakaan
                    hari ini.</p>

                <div
                    class="flex items-center gap-3 text-kombu/80 font-medium bg-kombu/5 px-3 py-2 rounded-full w-fit mt-3 text-sm">
                    <span>👋</span>
                    <span>Selamat datang, {{ auth()->user()->name ?? 'Admin' }}!</span>
                </div>

                <div
                    class="mt-3 bg-white inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-xl shadow-sm border text-xs sm:text-sm text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span id="realtimeClockDashboard"></span>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Script untuk Jam
            function updateClockDashboard() {
                const now = new Date();
                let date = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                let time = now.toLocaleTimeString('id-ID');
                const clockElement = document.getElementById('realtimeClockDashboard');
                if (clockElement) {
                    clockElement.innerHTML = `${date} • ${time}`;
                }
            }
            updateClockDashboard();
            setInterval(updateClockDashboard, 1000);

            // Script untuk Chart
            document.addEventListener('DOMContentLoaded', function () {
                // 1. Grafik Tren Peminjaman (Bar Chart)
                const chartCanvasDash = document.getElementById('chartBesarDashboard');
                if (chartCanvasDash) {
                    new Chart(chartCanvasDash, {
                        type: 'bar',
                        data: {
                            labels: @json($chartLabels),
                            datasets: [{
                                label: 'Jumlah Transaksi',
                                data: @json($chartValues),
                                backgroundColor: '#2D4030',
                                borderRadius: 6,
                                hoverBackgroundColor: '#435B47',
                                barThickness: 24,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: '#F3F4F6' },
                                    border: { dash: [4, 4] },
                                    ticks: { stepSize: 1, color: '#9CA3AF', font: { size: 11 } }
                                },
                                x: { grid: { display: false }, ticks: { color: '#9CA3AF', font: { size: 11 } } }
                            }
                        }
                    });
                }

                // 2. Grafik Status Ketersediaan Stok (Doughnut Chart)
                const stokCanvasDash = document.getElementById('chartStokBukuDashboard');
                if (stokCanvasDash) {
                    new Chart(stokCanvasDash, {
                        type: 'doughnut',
                        data: {
                            labels: ['Tersedia di Rak', 'Sedang Dipinjam'],
                            datasets: [{
                                data: [{{ $bukuDiRak }}, {{ $bukuSedangDipinjam }}],
                                backgroundColor: ['#435B47', '#E6A15C'],
                                borderWidth: 2,
                                borderColor: '#ffffff',
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            return ' ' + context.label + ': ' + (context.raw || 0) + ' Eks';
                                        }
                                    }
                                }
                            },
                            cutout: '72%'
                        }
                    });
                }
            });
        </script>

        <div class="bg-white p-5 rounded-xl shadow-sm border">
            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Akses Pintas Petugas</h4>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">

                <!-- Sirkulasi Baru -->
                <a href="{{ Route::has('admin.transaksi.create') ? route('admin.transaksi.create') : '#' }}"
                    class="flex items-center justify-center gap-2 bg-kombu hover:opacity-90 text-white p-3 rounded-xl text-sm font-medium transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Sirkulasi
                </a>

                <!-- Tambah Buku -->
                <a href="{{ Route::has('admin.buku.create') ? route('admin.buku.create') : '#' }}"
                    class="flex items-center justify-center gap-2 bg-asparagus hover:opacity-90 text-white p-3 rounded-xl text-sm font-medium transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Buku
                </a>

                <!-- Anggota Baru -->
                <a href="{{ Route::has('admin.anggota.create') ? route('admin.anggota.create') : '#' }}"
                    class="flex items-center justify-center gap-2 bg-secondary hover:opacity-90 text-white p-3 rounded-xl text-sm font-medium transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                    Anggota
                </a>

                <!-- Buka Laporan -->
                <a href="{{ Route::has('admin.laporan.index') ? route('admin.laporan.index') : '#' }}"
                    class="flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 p-3 rounded-xl text-sm font-medium transition-all border border-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    Laporan
                </a>

            </div>
        </div>

        @if(($stats['terlambat'] ?? $totalTerlambat ?? 0) > 0 || ($stokKritis ?? 0) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if(($stats['terlambat'] ?? $totalTerlambat ?? 0) > 0)
                    <div
                        class="flex items-start gap-3 bg-red-50 border border-red-200 p-4 rounded-xl text-sm text-red-700 shadow-sm">
                        <span class="text-lg">🔔</span>
                        <div>
                            <strong class="font-semibold">Perhatian Keterlambatan:</strong>
                            Terdapat <span class="font-bold text-red-600">{{ $stats['terlambat'] ?? $totalTerlambat }}</span>
                            transaksi peminjaman melewati batas waktu. Segera lakukan penagihan denda.
                        </div>
                    </div>
                @endif

                @if(($stokKritis ?? 0) > 0)
                    <div
                        class="flex items-start gap-3 bg-amber-50 border border-amber-200 p-4 rounded-xl text-sm text-amber-700 shadow-sm">
                        <span class="text-lg">📦</span>
                        <div>
                            <strong class="font-semibold">Stok Buku Menipis:</strong>
                            Ada <span class="font-bold text-amber-600">{{ $stokKritis }} judul buku</span> dengan sisa stok
                            tinggal
                            1 atau habis. Pertimbangkan pengadaan unit baru.
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-5">
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-kombu">
                <p class="text-gray-500 text-sm">Total Buku</p>
                <h2 class="text-2xl font-bold text-kombu">{{ $stats['total_buku'] ?? $totalBukuModel ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-olivine">
                <p class="text-gray-500 text-sm">Kategori</p>
                <h2 class="text-2xl font-bold text-olivine">{{ $stats['kategori'] ?? $totalKategori ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-mustard">
                <p class="text-gray-500 text-sm">Anggota</p>
                <h2 class="text-2xl font-bold text-mustard">{{ $stats['anggota'] ?? $totalAnggota ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-secondary">
                <p class="text-gray-500 text-sm">Peminjaman Aktif</p>
                <h2 class="text-2xl font-bold text-secondary">{{ $stats['peminjaman'] ?? $totalPeminjaman ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-red-500">
                <p class="text-gray-500 text-sm">Terlambat</p>
                <h2 class="text-2xl font-bold text-red-500">{{ $stats['terlambat'] ?? $totalTerlambat ?? 0 }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-5 rounded-xl shadow-sm border lg:col-span-2">
                <h3 class="text-lg font-bold text-kombu mb-4">Grafik Tren Peminjaman Buku</h3>
                <div style="height:320px;" class="relative p-2">
                    @if(count($chartValues ?? []) > 0)
                        <canvas id="chartBesarDashboard"></canvas>
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-gray-400 gap-2">
                            <p class="text-sm font-medium">Belum ada aktivitas sirkulasi grafik bulan ini</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <h3 class="text-lg font-bold text-kombu mb-4">Status Ketersediaan Stok</h3>
                <div style="height:320px;" class="relative flex flex-col justify-center items-center">
                    @if((($bukuDiRak ?? 0) + ($bukuSedangDipinjam ?? 0)) > 0)
                        <div class="w-full h-48">
                            <canvas id="chartStokBukuDashboard"></canvas>
                        </div>
                        <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mt-5 text-xs font-semibold text-gray-600">
                            <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-asparagus"></span>
                                Ready di Rak ({{ $bukuDiRak ?? 0 }} eks)</div>
                            <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-mustard"></span>
                                Dipinjam ({{ $bukuSedangDipinjam ?? 0 }} eks)</div>
                        </div>
                    @else
                        <div class="text-gray-400 text-sm text-center py-12">Belum ada aset data buku tersedia</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <h3 class="text-base font-bold text-kombu mb-4 pb-2 border-b">Buku Paling Banyak Dipinjam Bulan Ini</h3>
                <ul class="space-y-2">
                    @forelse($topBooks ?? [] as $index => $book)
                        <li
                            class="flex justify-between items-center bg-gray-50/50 hover:bg-gray-50 p-3 rounded-xl transition-colors border border-transparent hover:border-gray-100">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="text-xs font-bold text-gray-400 w-5 text-center">#{{ $index + 1 }}</span>
                                <span
                                    class="text-sm text-gray-700 font-medium truncate">{{ $book->book->judul ?? $book->judul ?? '-' }}</span>
                            </div>
                            <span
                                class="bg-asparagus/10 text-asparagus text-xs font-bold px-2.5 py-1 rounded-lg">{{ $book->total }}
                                Pinjam</span>
                        </li>
                    @empty
                        <li class="text-sm text-gray-400 text-center py-6">Tidak ada data transaksi tersedia</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border">
                <h3 class="text-base font-bold text-kombu mb-4 pb-2 border-b">Anggota Paling Aktif Meminjam Bulan Ini
                </h3>
                <ul class="space-y-2">
                    @forelse($topUsers ?? [] as $index => $user)
                        <li
                            class="flex justify-between items-center bg-gray-50/50 hover:bg-gray-50 p-3 rounded-xl transition-colors border border-transparent hover:border-gray-100">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="text-xs font-bold text-gray-400 w-5 text-center">#{{ $index + 1 }}</span>
                                <span
                                    class="text-sm text-gray-700 font-medium truncate">{{ $user->user->name ?? $user->name ?? '-' }}</span>
                            </div>
                            <span
                                class="bg-secondary/10 text-secondary text-xs font-bold px-2.5 py-1 rounded-lg">{{ $user->total }}
                                Kali</span>
                        </li>
                    @empty
                        <li class="text-sm text-gray-400 text-center py-6">Tidak ada data transaksi tersedia</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow-sm border lg:col-span-2 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-5 border-b flex justify-between items-center">
                        <h3 class="text-base font-bold text-red-600">Daftar Keterlambatan Pengembalian</h3>
                        <span
                            class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded lg:hidden animate-pulse">Geser
                            &rarr;</span>
                    </div>

                    <div class="overflow-x-auto whitespace-nowrap scrollbar-thin">
                        <table class="w-full text-sm min-w-[600px]">
                            <thead>
                                <tr class="border-b bg-gray-50 text-left text-gray-600 font-semibold">
                                    <th class="p-3 w-1/4">Nama Anggota</th>
                                    <th class="p-3 w-2/5">Judul Buku</th>
                                    <th class="p-3 w-1/5">Durasi Telat</th>
                                    <th class="p-3 w-1/5">Akumulasi Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($terlambat ?? [] as $item)
                                    <tr class="border-b hover:bg-gray-50/80 transition-colors">
                                        <td class="p-3 font-medium text-gray-800 max-w-[150px] truncate">
                                            {{ $item->user->name ?? '-' }}
                                        </td>
                                        <td class="p-3 text-gray-600 max-w-[250px] truncate">{{ $item->book->judul ?? '-' }}
                                        </td>
                                        <td class="p-3"><span
                                                class="bg-red-50 text-red-600 text-xs font-semibold px-2.5 py-1 rounded-lg">{{ $item->hari_telat }}
                                                Hari</span></td>
                                        <td class="p-3"><span class="text-red-600 font-bold">Rp
                                                {{ number_format($item->denda, 0, ',', '.') }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-8 text-gray-400 text-sm font-medium">Tidak ada
                                            keterlambatan pengembalian buku.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border flex flex-col">
                <h3 class="text-base font-bold text-kombu mb-4 pb-2 border-b">Log Aktivitas Petugas</h3>
                <div class="flow-root flex-1 overflow-y-auto max-h-[280px] pr-1">
                    <ul class="-mb-8">
                        @forelse($recentLogs ?? [] as $log)
                            <li>
                                <div class="relative pb-5">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                        aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-sm">💠</span>
                                        </div>
                                        <div class="flex-1 min-w-0 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-600">
                                                    {{ $log->activity_message ?? $log->message ?? 'Aktivitas terekam' }}
                                                </p>
                                            </div>
                                            <div class="text-right text-xs whitespace-nowrap text-gray-400">
                                                <time>{{ $log->created_at ? $log->created_at->diffForHumans() : 'Baru saja' }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <div class="text-sm text-gray-400 text-center py-12">Belum ada riwayat log aktivitas hari ini.
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>

    </div>

@endsection