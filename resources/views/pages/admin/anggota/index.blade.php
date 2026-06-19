@extends('layouts.admin')

@section('content')

<x-page
    title="Kelola Anggota"
    subtitle="Manajemen data anggota perpustakaan"
    :action="route('admin.anggota.create')"
    actionText="+ Tambah Anggota">

    <div class="mb-4">
        <x-search-filter
            :action="route('admin.anggota.index')"
            placeholder="Cari anggota..." />
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <div class="overflow-x-auto">

            <x-table
                :headers="[
        'Kode',
        'Nama',
        'Email',
        'No HP',
        'Aksi'
    ]">

                @forelse($anggotas as $item)

                <x-table-row>

                    <x-table-cell>{{ $item->kode_anggota }}</x-table-cell>

                    <x-table-cell>{{ $item->nama }}</x-table-cell>

                    <x-table-cell>{{ $item->email }}</x-table-cell>

                    <x-table-cell>{{ $item->no_hp }}</x-table-cell>

                    <x-table-cell>

                        <div class="flex gap-2 justify-center">

                            <a href="{{ route('admin.anggota.edit', $item->id) }}"
                                class="px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg text-sm">
                                Edit
                            </a>

                            <a href="{{ route('admin.anggota.show', $item->id) }}"
                                class="px-3 py-2 bg-blue-100 text-blue-600 rounded-lg text-sm">
                                Detail
                            </a>

                            <form method="POST"
                                action="{{ route('admin.anggota.destroy', $item->id) }}"
                                onsubmit="return confirm('Yakin hapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-3 py-2 bg-red-100 text-red-600 rounded-lg text-sm">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </x-table-cell>

                </x-table-row>

                @empty

                <tr>
                    <td colspan="5" class="text-center p-6 text-gray-500">
                        Data tidak ditemukan
                    </td>
                </tr>

                @endforelse

            </x-table>

        </div>

    </div>

</x-page>

@endsection