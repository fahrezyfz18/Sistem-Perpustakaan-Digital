@extends('layouts.admin')

@section('content')

    <x-page title="Data Kategori" subtitle="Manajemen data kategori buku perpustakaan"
        :action="route('admin.kategori.create')" actionText="+ Tambah Kategori">

        <!-- SEARCH -->
        <div class="mb-4">
            <x-search-filter :action="route('admin.kategori.index')" placeholder="Cari kategori..." />
        </div>

        <!-- TABLE -->

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">
                                Nama Kategori
                            </th>

                            <th class="px-6 py-4 text-center font-semibold">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $category->nama }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.kategori.edit', $category->id) }}" class="px-4 py-2 rounded-lg
                                          bg-yellow-100 text-yellow-700
                                          hover:bg-yellow-200 transition
                                          text-sm font-medium">
                                            Edit
                                        </a>

                                        <a href="{{ route('admin.kategori.show', $category->id) }}" class="px-4 py-2 rounded-lg
                                          bg-blue-100 text-blue-700
                                          hover:bg-blue-200 transition
                                          text-sm font-medium">
                                            Detail
                                        </a>

                                        <form method="POST" action="{{ route('admin.kategori.destroy', $category->id) }}"
                                            onsubmit="return confirm('Yakin hapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="px-4 py-2 rounded-lg
                                               bg-red-100 text-red-700
                                               hover:bg-red-200 transition
                                               text-sm font-medium">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="2" class="py-12 text-center">

                                    <div class="flex flex-col items-center gap-2">

                                        <span class="text-5xl"></span>

                                        <p class="text-gray-500">
                                            Belum ada data kategori.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </x-page>

@endsection