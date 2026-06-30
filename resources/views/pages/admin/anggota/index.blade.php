@extends('layouts.app')

@section('content')

    <x-page
        title="Kelola Anggota"
        subtitle="Manajemen data anggota perpustakaan"
        :action="route('admin.anggota.create')"
        actionText="Tambah Anggota"
    >

        <x-search-filter
            :action="route('admin.anggota.index')"
            placeholder="Cari anggota..." 
        />

        <x-table :headers="['Kode', 'Nama', 'Email', 'No HP', 'Aksi']">

            @forelse($anggotas as $item)
                <x-table-row>

                    <x-table-cell>
                        <span class="font-mono text-xs font-bold bg-gray-100 px-2 py-1 rounded border text-gray-700">
                            {{ $item->kode_anggota }}
                        </span>
                    </x-table-cell>
                    
                    <x-table-cell>
                        <div class="font-semibold text-gray-900">{{ $item->nama }}</div>
                    </x-table-cell>
                    
                    <x-table-cell>{{ $item->email }}</x-table-cell>
                    <x-table-cell>{{ $item->no_hp }}</x-table-cell>

                    <x-table-cell>
                        <div class="flex gap-2 justify-center">
                            <a href="{{ route('admin.anggota.show', $item->id) }}"
                               class="px-3 py-1.5 rounded-xl bg-olivine/10 text-kombu hover:bg-olivine/20 transition text-xs font-bold border border-olivine/20">
                                Detail
                            </a>

                            <a href="{{ route('admin.anggota.edit', $item->id) }}"
                               class="px-3 py-1.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition text-xs font-bold border border-amber-200/60">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.anggota.destroy', $item->id) }}"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1.5 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition text-xs font-bold border border-red-200/60">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </x-table-cell>

                </x-table-row>
            @empty
                <x-table-row>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium bg-white">
                        Data registrasi anggota tidak ditemukan.
                    </td>
                </x-table-row>
            @endforelse

        </x-table>

    </x-page>

@endsection