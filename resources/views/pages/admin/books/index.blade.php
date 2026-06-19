@extends('layouts.admin')

@section('content')

<x-page
    title="Kelola Data Buku"
    subtitle="Manajemen koleksi buku perpustakaan"
    :action="route('admin.buku.create')"
    actionText="+ Tambah Buku">

    @if(session('success'))
    <div id="successAlert"
        class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('successAlert');

            if (alert) {
                alert.style.transition = '0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
    @endif

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
                <div class="flex justify-center items-center gap-2">

                    <!-- DETAIL -->
                    <a href="{{ route('admin.buku.show', $book->id) }}"
                        class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition text-sm">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.478 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.064 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <span>Detail</span>

                    </a>

                    <!-- EDIT -->
                    <a href="{{ route('admin.buku.edit', $book->id) }}"
                        class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition text-sm">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16.862 4.487a2.1 2.1 0 113 2.97L7.5 19.82 3 21l1.18-4.5 12.682-12.013z" />

                        </svg>

                        <span>Edit</span>

                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('admin.buku.destroy', $book->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin hapus data ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition text-sm">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                           a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                           M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3
                           m-7 0h8" />

                            </svg>

                            <span>Hapus</span>

                        </button>

                    </form>

                </div>
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