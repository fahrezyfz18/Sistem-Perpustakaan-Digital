@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-primary">
        Filter Buku
    </h1>
</div>

<div class="bg-white rounded-2xl shadow p-6">

    <form method="GET"
          action="{{ route('user.books.filter') }}">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari judul buku..."
                   class="rounded-xl border-gray-300 focus:border-primary focus:ring-primary">

            <input type="text"
                   name="kategori"
                   value="{{ request('kategori') }}"
                   placeholder="Kategori..."
                   class="rounded-xl border-gray-300 focus:border-primary focus:ring-primary">

            <button type="submit"
                    class="bg-primary hover:bg-kombu text-white rounded-xl px-5 py-3 transition">
                Filter
            </button>

            <a href="{{ route('user.books.filter') }}"
               class="bg-gray-200 hover:bg-gray-300 rounded-xl px-5 py-3 text-center transition">
                Reset
            </a>

        </div>

    </form>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden mt-6">

    <table class="w-full">

        <thead class="bg-primary text-white">
            <tr>
                <th class="px-6 py-4 text-left">Judul</th>
                <th class="px-6 py-4 text-left">Penulis</th>
                <th class="px-6 py-4 text-left">Kategori</th>
            </tr>
        </thead>

        <tbody>

            @forelse($books as $book)

            <tr class="border-b">

                <td class="px-6 py-4">
                    {{ $book->judul }}
                </td>

                <td class="px-6 py-4">
                    {{ $book->penulis }}
                </td>

                <td class="px-6 py-4">
                    {{ $book->kategori }}
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="3" class="text-center py-6 text-gray-500">
                    Buku tidak ditemukan
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection