@extends('layouts.app')

@section('content')

<div class="p-6 bg-background min-h-screen">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-2xl font-semibold text-kombu">
            Riwayat Peminjaman
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Daftar histori peminjaman buku Anda
        </p>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <!-- TABLE HEAD -->
                <thead class="bg-primary text-white">

                    <tr>

                        <th class="p-4 text-left">
                            Buku
                        </th>

                        <th class="p-4 text-center">
                            Histori Pinjaman
                        </th>

                        <th class="p-4 text-center">
                            Tanggal Pinjam
                        </th>

                        <th class="p-4 text-center">
                            Tanggal Kembali
                        </th>

                        <th class="p-4 text-center">
                            Status
                        </th>

                    </tr>

                </thead>

                <!-- TABLE BODY -->
                <tbody>

                    @forelse($histories as $history)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <!-- BUKU -->
                            <td class="p-4 font-medium text-kombu">

                                {{ $history->book->judul ?? '-' }}

                            </td>

                            <!-- HISTORI -->
                            <td class="p-4 text-center text-gray-600">

                                Peminjaman Buku

                            </td>

                            <!-- TANGGAL PINJAM -->
                            <td class="p-4 text-center text-gray-600">

                                {{ \Carbon\Carbon::parse($history->tanggal_pinjam)->format('d M Y') }}

                            </td>

                            <!-- TANGGAL KEMBALI -->
                            <td class="p-4 text-center text-gray-600">

                                {{ \Carbon\Carbon::parse($history->tanggal_kembali)->format('d M Y') }}

                            </td>

                            <!-- STATUS -->
                            <td class="p-4 text-center">

                                @if($history->status == 'selesai')

                                    <span class="bg-olivine text-white px-3 py-1 rounded-full text-xs">
                                        Selesai
                                    </span>

                                @elseif($history->status == 'dipinjam')

                                    <span class="bg-mustard text-white px-3 py-1 rounded-full text-xs">
                                        Dipinjam
                                    </span>

                                @else

                                    <span class="bg-gray-400 text-white px-3 py-1 rounded-full text-xs">
                                        {{ ucfirst($history->status) }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="p-6 text-center text-gray-500">

                                Belum ada riwayat peminjaman

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="mt-5">

        {{ $histories->links() }}

    </div>

</div>

@endsection