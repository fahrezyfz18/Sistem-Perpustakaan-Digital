@extends('layouts.admin')

@section('content')

<div class="p-6 bg-background min-h-screen">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl md:text-3xl font-semibold text-primary">
                Laporan & Statistik
            </h1>
            <p class="text-sm text-gray-500">
                Analisis data perpustakaan
            </p>
        </div>

        <div class="flex gap-2">
            <a href="#" class="bg-asparagus text-white px-4 py-2 rounded-lg">Excel</a>
            <a href="#" class="bg-secondary text-white px-4 py-2 rounded-lg">PDF</a>
        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form class="flex flex-col md:flex-row gap-3">
            <input type="date" class="border px-3 py-2 rounded w-full">
            <input type="date" class="border px-3 py-2 rounded w-full">
            <button class="bg-primary text-white px-4 py-2 rounded">Filter</button>
        </form>
    </div>

    <!-- GRAFIK BESAR -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold text-primary mb-4">
            Grafik Peminjaman
        </h3>
        <canvas id="chartBesar"></canvas>
    </div>

    <!-- TOP DATA -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        <!-- TOP 5 BUKU -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold text-primary mb-3">Top 5 Buku</h3>
            <ul class="space-y-2 text-sm">
                @forelse($topBooks ?? [] as $book)
                    <li class="flex justify-between border-b pb-1">
                        <span>{{ $book->judul }}</span>
                        <span>{{ $book->total }}x</span>
                    </li>
                @empty
                    <p class="text-gray-500">Tidak ada data</p>
                @endforelse
            </ul>
        </div>

        <!-- TOP USER -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold text-primary mb-3">Anggota Aktif</h3>
            <ul class="space-y-2 text-sm">
                @forelse($topUsers ?? [] as $user)
                    <li class="flex justify-between border-b pb-1">
                        <span>{{ $user->nama }}</span>
                        <span>{{ $user->total }}x</span>
                    </li>
                @empty
                    <p class="text-gray-500">Tidak ada data</p>
                @endforelse
            </ul>
        </div>

    </div>

    <!-- KETERLAMBATAN -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-semibold text-primary mb-4">
            Data Keterlambatan
        </h3>

        <table class="w-full text-sm">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-2">Nama</th>
                    <th class="p-2">Buku</th>
                    <th class="p-2 text-center">Telat</th>
                    <th class="p-2 text-center">Denda</th>
                </tr>
            </thead>

            <tbody>
                @forelse($terlambat ?? [] as $t)
                <tr class="border-b">
                    <td class="p-2">{{ $t->nama }}</td>
                    <td class="p-2">{{ $t->judul }}</td>
                    <td class="p-2 text-center">{{ $t->telat_hari }} hari</td>
                    <td class="p-2 text-center text-red-500">
                        Rp {{ number_format($t->denda,0,',','.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-3 text-gray-500">
                        Tidak ada keterlambatan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('chartBesar'), {
    type: 'bar',
    data: {
        labels: @json($labels ?? []),
        datasets: [{
            label: 'Peminjaman',
            data: @json($values ?? [])
        }]
    }
});
</script>

@endsection