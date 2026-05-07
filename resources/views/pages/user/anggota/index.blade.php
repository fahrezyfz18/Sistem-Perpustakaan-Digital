@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-primary">
        Daftar Buku
    </h1>

    <p class="text-gray-500 mt-2">
        List seluruh buku perpustakaan
    </p>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-primary text-white">
            <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Judul</th>
                <th class="px-6 py-4 text-left">Penulis</th>
                <th class="px-6 py-4 text-left">Kategori</th>
                <th class="px-6 py-4 text-left">Stok</th>
            </tr>
        </thead>

        <tbody>

            @forelse($books as $book)

            <tr class="border-b hover:bg-gray-50 transition">

                <td class="px-6 py-4">
                    {{ $loop->iteration }}
                </td>

                <td class="px-6 py-4 font-medium">
                    {{ $book->judul }}
                </td>

                <td class="px-6 py-4">
                    {{ $book->penulis }}
                </td>

                <td class="px-6 py-4">
                    {{ $book->kategori }}
                </td>

                <td class="px-6 py-4">
                    {{ $book->stok }}
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="text-center py-6 text-gray-500">
                    Data buku kosong
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection