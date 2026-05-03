@extends('layouts.admin')

@section('content')

<div class="p-6 bg-background min-h-screen">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-primary">
            Laporan & Statistik
        </h1>

        <!-- 🔥 EXPORT BUTTON -->
        <div class="flex gap-2">
            <a href="{{ route('admin.laporan.export', ['type' => 'excel']) }}"
                class="bg-asparagus text-white px-4 py-2 rounded shadow hover:bg-olivine transition">
                Export Excel
            </a>

            <a href="{{ route('admin.laporan.export', ['type' => 'pdf']) }}"
                class="bg-secondary text-white px-4 py-2 rounded shadow hover:bg-camel transition">
                Export PDF
            </a>
        </div>
    </div>

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-primary text-white p-4 rounded shadow">
            <p>Peminjaman Bulan Ini</p>
            <h2 class="text-2xl font-bold">{{ $peminjamanBulanIni }}</h2>
        </div>

        <div class="bg-asparagus text-white p-4 rounded shadow">
            <p>Pengembalian Bulan Ini</p>
            <h2 class="text-2xl font-bold">{{ $pengembalianBulanIni }}</h2>
        </div>

        <div class="bg-camel text-white p-4 rounded shadow">
            <p>Denda Bulan Ini</p>
            <h2 class="text-2xl font-bold">
                Rp {{ number_format($totalDenda, 0, ',', '.') }}
            </h2>
        </div>

        <div class="bg-secondary text-white p-4 rounded shadow">
            <p>Anggota Baru</p>
            <h2 class="text-2xl font-bold">{{ $anggotaBaru }}</h2>
        </div>

    </div>

    <!-- 🔥 GRAFIK -->
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-lg font-semibold mb-4 text-primary">
            Grafik Peminjaman per Bulan
        </h2>

        <canvas id="chartPeminjaman"></canvas>
    </div>

</div>

<!-- 🔥 CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartPeminjaman');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: @json($values),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
</script>

@endsection