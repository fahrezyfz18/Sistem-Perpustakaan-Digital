@extends('layouts.app')

@section('content')

    <x-page 
        title="Data Kategori" 
        subtitle="Manajemen data kategori buku perpustakaan"
        :action="route('admin.kategori.create')" 
        actionText="Tambah Kategori"
    >

        <x-search-filter 
            :action="route('admin.kategori.index')" 
            placeholder="Cari kategori..." 
        />

        <x-table :headers="['Nama Kategori', 'Aksi']">

            @forelse($categories as $category)
                <x-table-row>

                    <x-table-cell>
                        <div class="font-semibold text-gray-900">
                            {{ $category->nama }}
                        </div>
                    </x-table-cell>

                    <x-table-cell>
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.kategori.show', $category->id) }}" 
                               class="px-3 py-1.5 rounded-xl bg-olivine/10 text-kombu hover:bg-olivine/20 transition text-xs font-bold border border-olivine/20">
                                Detail
                            </a>

                            <a href="{{ route('admin.kategori.edit', $category->id) }}" 
                               class="px-3 py-1.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition text-xs font-bold border border-amber-200/60">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.kategori.destroy', $category->id) }}"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition text-xs font-bold border border-red-200/60">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </x-table-cell>

                </x-table-row>
            @empty
                <x-table-row>
                    <td colspan="2" class="px-6 py-12 text-center text-gray-400 font-medium bg-white">
                        Belum ada data kategori buku yang terekam.
                    </td>
                </x-table-row>
            @endforelse

        </x-table>

    </x-page>

@endsection