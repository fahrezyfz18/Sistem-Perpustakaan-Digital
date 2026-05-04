@extends('layouts.admin')

@section('content')

<!-- WRAPPER -->
<div class="p-6 bg-background min-h-screen">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl md:text-3xl font-semibold text-kombu tracking-tight">
                Kelola Anggota
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Manajemen data anggota perpustakaan
            </p>
        </div>

        <a href="{{ route('admin.anggota.create') }}"
           class="inline-flex items-center bg-secondary text-white px-4 py-2 rounded-lg hover:bg-camel transition">
            + Tambah Anggota
        </a>

    </div>

    <!-- SEARCH -->
    <div class="mb-4">
        <form method="GET" class="relative">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama, email, atau kode anggota..."
                   class="w-full border rounded-lg py-2 pl-10 pr-4 
                          focus:ring-2 focus:ring-primary outline-none transition">

            <!-- ICON -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </div>

        </form>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <!-- HEAD -->
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Kode</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">No HP</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                    @forelse($anggotas as $item)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $item->kode_anggota }}</td>
                            <td class="p-3">{{ $item->nama }}</td>
                            <td class="p-3">{{ $item->email }}</td>
                            <td class="p-3">{{ $item->no_hp }}</td>

                            <!-- AKSI -->
                            <td class="p-3">
                                <div class="flex justify-center gap-3">

                                    <a href="{{ route('admin.anggota.edit', $item->id) }}"
                                       class="text-yellow-500 hover:underline">
                                        Edit
                                    </a>

                                    <a href="{{ route('admin.anggota.show', $item->id) }}"
                                       class="text-blue-500 hover:underline">
                                        Detail
                                    </a>

                                    <form action="{{ route('admin.anggota.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus data ini?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-500 hover:underline">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">
                                Data anggota tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        <div class="p-4 border-t flex justify-end">
            {{ $anggotas->appends(request()->query())->links() }}
        </div>

    </div>

</div>

@endsection