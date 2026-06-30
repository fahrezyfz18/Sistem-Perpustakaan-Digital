@extends('layouts.app') @section('content')

    <div class="min-h-screen bg-background p-4 sm:p-6">

        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-bold text-kombu">
                    Laporan & Statistik
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Analisis dan ringkasan data perpustakaan digital
                </p>
                <div
                    class="mt-3 bg-white inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-lg shadow border text-xs sm:text-sm text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span id="realtimeClock"></span>
                </div>
            </div>

            <div class="flex gap-2 text-sm">
                <a href="{{ route('admin.laporan.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                    class="bg-asparagus hover:opacity-90 transition-opacity text-white font-medium px-4 py-2.5 rounded-xl shadow text-center flex-1 sm:flex-none">
                    Export Excel
                </a>
                <a href="{{ route('admin.laporan.export', ['type' => 'pdf', 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                    class="bg-secondary hover:opacity-90 transition-opacity text-white font-medium px-4 py-2.5 rounded-xl shadow text-center flex-1 sm:flex-none">
                    Export PDF
                </a>
            </div>
        </div>

        <script>
            function updateClock() {
                const now = new Date();
                let date = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                let time = now.toLocaleTimeString('id-ID');
                document.getElementById('realtimeClock').innerHTML = `${date} • ${time}`;
            }
            updateClock();
            setInterval(updateClock, 1000);
        </script>

        <div class="bg-white p-5 rounded-xl shadow border mb-6">
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-col md:flex-row gap-3">
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="border border-gray-200 focus:border-kombu focus:ring-kombu px-4 py-2.5 rounded-xl w-full text-gray-700 text-sm">

                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="border border-gray-200 focus:border-kombu focus:ring-kombu px-4 py-2.5 rounded-xl w-full text-gray-700 text-sm">

                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="bg-kombu hover:opacity-90 text-white font-medium px-6 py-2.5 rounded-xl text-sm flex-1 md:flex-none">
                        Filter
                    </button>
                    <a href="{{ route('admin.laporan.index') }}"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2.5 rounded-xl text-sm font-medium text-center border border-gray-200 flex-1 md:flex-none">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if(request('start_date') && request('end_date'))
            <div class="mb-5 px-4 py-2.5 bg-gray-50 rounded-xl border inline-block text-sm text-gray-600 font-medium">
                Menampilkan data dari <span
                    class="text-kombu">{{ \Carbon\Carbon::parse(request('start_date'))->translatedFormat('d F Y') }}</span>
                sampai <span
                    class="text-kombu">{{ \Carbon\Carbon::parse(request('end_date'))->translatedFormat('d F Y') }}</span>
            </div>
        @endif

        <div class="mb-2">
            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Ringkasan Data Perpustakaan</h4>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-5 mb-8">

            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-kombu">
                <p class="text-gray-500 text-sm">Total Buku</p>
                <h2 class="text-2xl font-bold text-kombu">{{ $stats['total_buku'] ?? $totalBukuModel ?? 0 }}</h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-olivine">
                <p class="text-gray-500 text-sm">Kategori</p>
                <h2 class="text-2xl font-bold text-olivine">{{ $stats['kategori'] ?? $totalKategori ?? 0 }}</h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-mustard">
                <p class="text-gray-500 text-sm">Anggota</p>
                <h2 class="text-2xl font-bold text-mustard">{{ $stats['anggota'] ?? $totalAnggota ?? 0 }}</h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-secondary">
                <p class="text-gray-500 text-sm">Peminjaman Aktif</p>
                <h2 class="text-2xl font-bold text-secondary">{{ $stats['peminjaman'] ?? $totalPeminjaman ?? 0 }}</h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-red-500">
                <p class="text-gray-500 text-sm">Terlambat</p>
                <h2 class="text-2xl font-bold text-red-500">{{ $stats['terlambat'] ?? $totalTerlambat ?? 0 }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-olivine">
                <p class="text-gray-500 text-sm">Total Dikembalikan</p>
                <h2 class="text-2xl font-bold text-olivine">{{ $totalDikembalikan ?? 0 }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow border-l-4 border-mustard">
                <p class="text-gray-500 text-sm">Total Denda Terkumpul</p>
                <h2 class="text-2xl font-bold text-mustard">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-5 rounded-xl shadow lg:col-span-2">
                <h3 class="text-lg font-bold text-kombu mb-4">Grafik Tren Peminjaman Buku</h3>
                <div style="height:320px;" class="relative p-2">
                    @if(count($chartValues ?? []) > 0)
                        <canvas id="chartBesar"></canvas>
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-gray-400 gap-2">
                            <p class="text-sm font-medium">Tidak ada data transaksi pada periode yang dipilih</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-lg font-bold text-kombu mb-4">Status Ketersediaan Stok</h3>
                <div style="height:320px;" class="relative flex flex-col justify-center items-center">
                    @if((($bukuDiRak ?? 0) + ($bukuSedangDipinjam ?? 0)) > 0)
                        <div class="w-full h-48">
                            <canvas id="chartStokBuku"></canvas>
                        </div>
                        <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mt-5 text-xs font-semibold text-gray-600">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-asparagus"></span>
                                Ready di Rak ({{ $bukuDiRak ?? 0 }} eks)
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-mustard"></span>
                                Dipinjam ({{ $bukuSedangDipinjam ?? 0 }} eks)
                            </div>
                        </div>
                    @else
                        <div class="text-gray-400 text-sm text-center py-12">Belum ada aset data buku tersedia</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-base font-bold text-kombu mb-4 pb-2 border-b">Buku Paling Banyak Dipinjam Bulan Ini</h3>
                <ul class="space-y-2">
                    @forelse($topBooks ?? [] as $index => $book)
                        <li
                            class="flex justify-between items-center bg-gray-50/50 hover:bg-gray-50 p-3 rounded-xl border border-transparent hover:border-gray-100 transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="text-xs font-bold text-gray-400 w-5 text-center">#{{ $index + 1 }}</span>
                                <span
                                    class="text-sm text-gray-700 font-medium truncate">{{ $book->book->judul ?? $book->judul ?? '-' }}</span>
                            </div>
                            <span class="bg-asparagus/10 text-asparagus text-xs font-bold px-2.5 py-1 rounded-lg">
                                {{ $book->total }} Pinjam
                            </span>
                        </li>
                    @empty
                        <li class="text-sm text-gray-400 text-center py-6">Tidak ada data transaksi tersedia</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-base font-bold text-kombu mb-4 pb-2 border-b">Anggota Paling Aktif Meminjam Bulan Ini</h3>
                <ul class="space-y-2">
                    @forelse($topUsers ?? [] as $index => $user)
                        <li
                            class="flex justify-between items-center bg-gray-50/50 hover:bg-gray-50 p-3 rounded-xl border border-transparent hover:border-gray-100 transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                <span class="text-xs font-bold text-gray-400 w-5 text-center">#{{ $index + 1 }}</span>
                                <span
                                    class="text-sm text-gray-700 font-medium truncate">{{ $user->user->name ?? $user->name ?? '-' }}</span>
                            </div>
                            <span class="bg-secondary/10 text-secondary text-xs font-bold px-2.5 py-1 rounded-lg">
                                {{ $user->total }} Kali
                            </span>
                        </li>
                    @empty
                        <li class="text-sm text-gray-400 text-center py-6">Tidak ada data transaksi tersedia</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- TABLE KETERLAMBATAN (Bisa di-slide/scroll horizontal di HP) -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-5 border-b flex justify-between items-center">
                <h3 class="text-base font-bold text-red-600">Daftar Keterlambatan Pengembalian</h3>
                <!-- Indikator Geser khusus Mobile -->
                <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded md:hidden animate-pulse">
                    Geser &rarr;
                </span>
            </div>

            <!-- Pembungkus Scroll Otomatis -->
            <div class="overflow-x-auto whitespace-nowrap scrollbar-thin">
                <!-- min-w-[600px] memaksa tabel memiliki lebar minimal 600px di mobile sehingga memicu fungsi slide/scroll -->
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
                                <!-- Tambah truncate agar teks panjang tidak merusak baris -->
                                <td class="p-3 font-medium text-gray-800 max-w-[150px] truncate">
                                    {{ $item->user->name ?? '-' }}
                                </td>
                                <td class="p-3 text-gray-600 max-w-[250px] truncate">
                                    {{ $item->book->judul ?? '-' }}
                                </td>
                                <td class="p-3">
                                    <span class="bg-red-50 text-red-600 text-xs font-semibold px-2.5 py-1 rounded-lg">
                                        {{ $item->hari_telat }} Hari
                                    </span>
                                </td>
                                <td class="p-3">
                                    <span class="text-red-600 font-bold">
                                        Rp {{ number_format($item->denda, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-8 text-gray-400 text-sm font-medium">
                                    Saat ini tidak ada data keterlambatan pengembalian buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartCanvas = document.getElementById('chartBesar');
            if (chartCanvas) {
                new Chart(chartCanvas, {
                    type: 'bar',
                    data: {
                        labels: @json($chartLabels ?? []),
                        datasets: [{
                            label: 'Jumlah Transaksi Peminjaman ',
                            data: @json($chartValues ?? []),
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
                            y: { grid: { color: '#F3F4F6' }, border: { dash: [4, 4] }, ticks: { color: '#9CA3AF', font: { size: 11 } } },
                            x: { grid: { display: false }, ticks: { color: '#9CA3AF', font: { size: 11 } } }
                        }
                    }
                });
            }

            const stokCanvas = document.getElementById('chartStokBuku');
            if (stokCanvas) {
                new Chart(stokCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Tersedia di Rak', 'Sedang Dipinjam'],
                        datasets: [{
                            data: [{{ $bukuDiRak ?? 0 }}, {{ $bukuSedangDipinjam ?? 0 }}],
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
                                        return ' ' + context.label + ': ' + (context.raw || 0) + ' Eksemplar';
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
@endsection