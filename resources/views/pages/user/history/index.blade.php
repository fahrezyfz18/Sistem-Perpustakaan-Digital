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

        <table class="w-full text-sm">

            <thead class="bg-primary text-white">

                <tr>

                    <th class="p-4 text-left">
                        Buku
                    </th>

                    <th class="p-4 text-center">
                        Tanggal Pinjam
                    </th>

                    <th class="p-4 text-center">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($histories as $history)

                    <tr class="border-b">

                        <td class="p-4">
                            {{ $history->book->judul ?? '-' }}
                        </td>

                        <td class="p-4 text-center">
                            {{ $history->created_at->format('d M Y') }}
                        </td>

                        <td class="p-4 text-center">

                            @if($history->status == 'dipinjam')

                                <span class="bg-mustard text-white px-3 py-1 rounded text-xs">
                                    Dipinjam
                                </span>

                            @else

                                <span class="bg-olivine text-white px-3 py-1 rounded text-xs">
                                    Dikembalikan
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="p-6 text-center text-gray-500">

                            Belum ada riwayat peminjaman

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection