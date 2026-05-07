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

        <!-- BUTTON EXPORT -->
        <div class="flex gap-2">

            <a href="{{ route('admin.laporan.export') }}"
                class="bg-asparagus hover:bg-olivine transition text-white px-4 py-2 rounded-lg">
                Excel
            </a>

            <a href="{{ route('admin.laporan.export', ['type' => 'pdf']) }}"
                class="bg-secondary hover:bg-mustard transition text-white px-4 py-2 rounded-lg">
                PDF
            </a>

        </div>

    </div>


    <!-- FILTER -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">

        <form class="flex flex-col md:flex-row gap-3">

            <input type="date"
                class="border px-3 py-2 rounded w-full">

            <input type="date"
                class="border px-3 py-2 rounded w-full">

            <button class="bg-primary text-white px-4 py-2 rounded">
                Filter
            </button>

        </form>

    </div>


    <!-- GRAFIK -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">

        <h3 class="text-lg font-semibold text-primary mb-4">
            Grafik Peminjaman
        </h3>

        <canvas id="chartBesar"></canvas>

    </div>


    <!-- TOP DATA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <!-- TOP BUKU -->
        <div class="bg-white p-4 rounded-lg shadow">

            <h3 class="font-semibold text-primary mb-3">
                Top 5 Buku
            </h3>

            <ul class="space-y-2 text-sm">

                @forelse($topBooks ?? [] as $book)

                    <li class="flex justify-between border-b pb-1">
                        <span>{{ $book->judul }}</span>
                        <span>{{ $book->total }}x</span>
                    </li>

                @empty

                    <p class="text-gray-500">
                        Tidak ada data
                    </p>

                @endforelse

            </ul>

        </div>


        <!-- TOP USER -->
        <div class="bg-white p-4 rounded-lg shadow">

            <h3 class="font-semibold text-primary mb-3">
                Anggota Aktif
            </h3>

            <ul class="space-y-2 text-sm">

                @forelse($topUsers ?? [] as $user)

                    <li class="flex justify-between border-b pb-1">
                        <span>{{ $user->nama }}</span>
                        <span>{{ $user->total }}x</span>
                    </li>

                @empty

                    <p class="text-gray-500">
                        Tidak ada data
                    </p>

                @endforelse

            </ul>

        </div>

    </div>


    <!-- DATA KETERLAMBATAN -->
    <div class="bg-white p-6 rounded-lg shadow">

        <h3 class="font-semibold text-primary mb-4">
            Data Keterlambatan
        </h3>

        <table class="w-full text-sm">

            <thead class="bg-primary text-white">

                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Buku</th>
                    <th class="p-3 text-center">Telat</th>
                    <th class="p-3 text-center">Denda</th>
                </tr>

            </thead>

            <tbody>

                @forelse($terlambat as $item)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            {{ $item->nama }}
                        </td>

                        <td class="p-3">
                            {{ $item->judul }}
                        </td>

                        <td class="p-3 text-center text-red-500 font-semibold">
                            {{ $item->hari_telat }} Hari
                        </td>

                        <td class="p-3 text-center text-red-500 font-bold">
                            Rp {{ number_format($item->denda, 0, ',', '.') }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center p-4 text-gray-500">

                            Tidak ada keterlambatan

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('chartBesar'), {

    type: 'bar',

    data: {

        labels: ['May'],

        datasets: [{
            label: 'Peminjaman',
            data: [{{ count($terlambat) }}]
        }]
    }

});

</script>

@endsection