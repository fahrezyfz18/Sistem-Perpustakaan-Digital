@extends('layouts.admin')

@section('content')

<x-page
    title="Kelola Data Buku"
    subtitle="Manajemen koleksi buku perpustakaan"
    :action="route('admin.buku.create')"
    actionText="+ Tambah Buku">

    <!-- SEARCH -->
    <div class="mb-4">
        <x-search-filter
            :action="route('admin.buku.index')"
            placeholder="Cari judul atau penulis..."
            :categories="$categories ?? []" />
    </div>

    <!-- TABLE -->
    <x-table
        :headers="[
        'Cover',
        'Judul',
        'ISBN',
        'Penulis',
        'Penerbit',
        'Kategori',
        'Tahun',
        'Stok',
        'Aksi'
    ]">

        @forelse($books as $book)

        <x-table-row>

            <x-table-cell>
                @if($book->cover)
                <img src="{{ asset('storage/'.$book->cover) }}"
                    class="w-14 h-20 object-cover rounded mx-auto">
                @endif
            </x-table-cell>

            <x-table-cell>{{ $book->judul }}</x-table-cell>
            <x-table-cell>{{ $book->isbn }}</x-table-cell>
            <x-table-cell>{{ $book->penulis }}</x-table-cell>
            <x-table-cell>{{ $book->penerbit }}</x-table-cell>
            <x-table-cell>{{ $book->kategori }}</x-table-cell>
            <x-table-cell>{{ $book->tahun }}</x-table-cell>
            <x-table-cell>{{ $book->stok }}</x-table-cell>

            <x-table-cell>
                tombol aksi
            </x-table-cell>

        </x-table-row>

        @empty

        <tr>
            <td colspan="9" class="text-center p-6 text-gray-500">
                Data buku tidak ditemukan
            </td>
        </tr>

        @endforelse

    </x-table>

    </div>

    </div>

</x-page>

@endsection