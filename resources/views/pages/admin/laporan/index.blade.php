@extends('layouts.admin')

@section('content')

<x-page
    title="Laporan & Statistik"
    subtitle="Analisis data perpustakaan">

    <div class="mt-3 bg-white inline-block px-3 py-2 rounded-lg shadow border text-sm text-gray-600 mb-5">
        <span id="realtimeClock"></span>
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

            document.getElementById('realtimeClock')
                .innerHTML = `${date} • ${time}`;
        }

        updateClock();
        setInterval(updateClock, 1000);
    </script>

    <x-slot name="headerActions">

        <a href="{{ route('admin.laporan.export', [
            'start_date' => request('start_date'),
            'end_date' => request('end_date')
        ]) }}"
            class="bg-asparagus hover:bg-olivine transition text-white px-4 py-2 rounded-lg">

            Export Excel

        </a>

        <a href="{{ route('admin.laporan.export', [
            'type' => 'pdf',
            'start_date' => request('start_date'),
            'end_date' => request('end_date')
        ]) }}"
            class="bg-secondary hover:bg-mustard transition text-white px-4 py-2 rounded-lg">

            Export PDF

        </a>

    </x-slot>

    <!-- FILTER -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">

        <form
            method="GET"
            action="{{ route('admin.laporan.index') }}"
            class="flex flex-col md:flex-row gap-3">

            <input
                type="date"
                name="start_date"
                value="{{ request('start_date') }}"
                class="border border-gray-300 px-3 py-2 rounded-lg w-full">

            <input
                type="date"
                name="end_date"
                value="{{ request('end_date') }}"
                class="border border-gray-300 px-3 py-2 rounded-lg w-full">

            <button
                type="submit"
                class="bg-kombu text-white px-4 py-2 rounded-lg">

                Filter

            </button>

            <a
                href="{{ route('admin.laporan.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg text-center">

                Reset

            </a>

        </form>

    </div>

    <!-- CARD STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">

        <div class="bg-white p-5 rounded-xl shadow border-l-4 border-kombu">
            <p class="text-gray-500 text-sm">Total Peminjaman</p>
            <h2 class="text-2xl font-bold text-kombu">
                {{ $totalPeminjaman }}
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow border-l-4 border-olivine">
            <p class="text-gray-500 text-sm">Dikembalikan</p>
            <h2 class="text-2xl font-bold text-olivine">
                {{ $totalDikembalikan }}
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow border-l-4 border-red-500">
            <p class="text-gray-500 text-sm">Terlambat</p>
            <h2 class="text-2xl font-bold text-red-500">
                {{ $totalTerlambat }}
            </h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow border-l-4 border-mustard">
            <p class="text-gray-500 text-sm">Total Denda</p>
            <h2 class="text-2xl font-bold text-mustard">
                Rp {{ number_format($totalDenda,0,',','.') }}
            </h2>
        </div>

    </div>

    <!-- KETERANGAN FILTER -->
    @if(request('start_date') && request('end_date'))

        <div class="mb-4 text-sm text-gray-500">

            Menampilkan data dari

            {{ \Carbon\Carbon::parse(request('start_date'))->translatedFormat('d F Y') }}

            sampai

            {{ \Carbon\Carbon::parse(request('end_date'))->translatedFormat('d F Y') }}

        </div>

    @endif

    <!-- CHART -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">

        <h3 class="text-lg font-semibold text-primary mb-4">
            Grafik Peminjaman
        </h3>

        <div style="height:350px;">

            @if(count($chartValues) > 0)

                <canvas id="chartBesar"></canvas>

            @else

                <div class="flex items-center justify-center h-full text-gray-500">

                    Tidak ada data pada periode yang dipilih

                </div>

            @endif

        </div>

    </div>

    <!-- TOP DATA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <!-- TOP BUKU -->
        <div class="bg-white p-5 rounded-xl shadow">

            <h3 class="text-lg font-semibold text-kombu mb-4">
                Top 5 Buku Terpopuler
            </h3>

            <ul class="space-y-2 text-sm">

                @forelse($topBooks as $book)

                    <li class="flex justify-between border-b pb-2">

                        <span>
                            {{ $book->book->judul ?? '-' }}
                        </span>

                        <span class="font-semibold">
                            {{ $book->total }}x
                        </span>

                    </li>

                @empty

                    <li class="text-gray-500">
                        Tidak ada data
                    </li>

                @endforelse

            </ul>

        </div>

        <!-- TOP USER -->
        <div class="bg-white p-5 rounded-xl shadow">

            <h3 class="text-lg font-semibold text-kombu mb-4">
                Anggota Aktif
            </h3>

            <ul class="space-y-2 text-sm">

                @forelse($topUsers as $user)

                    <li class="flex justify-between border-b pb-2">

                        <span>
                            {{ $user->user->name ?? '-' }}
                        </span>

                        <span class="font-semibold">
                            {{ $user->total }}x
                        </span>

                    </li>

                @empty

                    <li class="text-gray-500">
                        Tidak ada data
                    </li>

                @endforelse

            </ul>

        </div>

    </div>

    <!-- DATA KETERLAMBATAN -->
    <x-table
        :headers="[
            'Nama',
            'Buku',
            'Hari Terlambat',
            'Denda'
        ]">

        @forelse($terlambat as $item)

            <x-table-row>

                <x-table-cell>
                    {{ $item->user->name ?? '-' }}
                </x-table-cell>

                <x-table-cell>
                    {{ $item->book->judul ?? '-' }}
                </x-table-cell>

                <x-table-cell>

                    <span class="text-red-500 font-semibold">
                        {{ $item->hari_telat }} Hari
                    </span>

                </x-table-cell>

                <x-table-cell>

                    <span class="text-red-500 font-bold">
                        Rp {{ number_format($item->denda,0,',','.') }}
                    </span>

                </x-table-cell>

            </x-table-row>

        @empty

            <tr>

                <td colspan="4" class="text-center p-6 text-gray-500">
                    Tidak ada keterlambatan
                </td>

            </tr>

        @endforelse

    </x-table>

</x-page>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const chartCanvas = document.getElementById('chartBesar');

    if (!chartCanvas) {
        return;
    }

    new Chart(chartCanvas, {

        type: 'bar',

        data: {

            labels: @json($chartLabels),

            datasets: [{
                label: 'Jumlah Peminjaman',
                data: @json($chartValues)
            }]

        },

        options: {
            responsive: true,
            maintainAspectRatio: false
        }

    });

});
</script>

@endsection