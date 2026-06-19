@extends('layouts.admin')

@section('content')

<x-page title="Data Kategori" subtitle="Manajemen data kategori buku perpustakaan"
    :action="route('admin.kategori.create')" actionText="+ Tambah Kategori">

    <!-- SEARCH -->
    <div class="mb-4">
        <x-search-filter
            :action="route('admin.kategori.index')"
            placeholder="Cari kategori..." />
    </div>

    <!-- TABLE -->
    <x-table
        :headers="[
        'Nama Kategori',
        'Aksi'
    ]">

        @forelse($categories as $category)

        <x-table-row>

            <x-table-cell>
                {{ $category->nama }}
            </x-table-cell>

            <x-table-cell>

                <div class="flex justify-center gap-2">

                    <a href="{{ route('admin.kategori.edit',$category->id) }}"
                        class="px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg">
                        Edit
                    </a>

                    <form method="POST"
                        action="{{ route('admin.kategori.destroy',$category->id) }}">
                        @csrf
                        @method('DELETE')

                        <button class="px-3 py-2 bg-red-100 text-red-600 rounded-lg">
                            Hapus
                        </button>

                    </form>

                </div>

            </x-table-cell>

        </x-table-row>

        @empty

        <tr>
            <td colspan="2" class="p-6 text-center text-gray-500">
                Data tidak ditemukan
            </td>
        </tr>

        @endforelse

    </x-table>

    </div>

    </div>

</x-page>

@endsection