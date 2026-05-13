@extends('layouts.admin')

@section('content')

    <!-- WRAPPER -->
    <div class="p-6 bg-background min-h-screen">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl md:text-3xl font-semibold text-kombu tracking-tight">
                    Kelola Data Buku
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Manajemen koleksi buku perpustakaan
                </p>
            </div>

            <a href="{{ route('admin.buku.create') }}"
                class="inline-flex items-center bg-secondary text-white px-4 py-2 rounded-lg hover:bg-camel transition">
                + Tambah Buku
            </a>

        </div>

        <!-- SEARCH -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.buku.index') }}" class="relative">

                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul, penulis, atau kategori..."
                    class="w-full border rounded-lg py-2 pl-10 pr-4 
                           focus:ring-2 focus:ring-primary outline-none transition">

                <!-- ICON -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                    <svg class="w-5 h-5 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />

                    </svg>

                </div>

            </form>
        </div>

        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="bg-olivine text-white px-4 py-3 rounded-lg mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE CARD -->
        <div class="bg-white shadow rounded-lg overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <!-- HEAD -->
                    <thead class="bg-primary text-white">

                        <tr>

                            <th class="px-4 py-4 text-center align-middle">
                                Cover
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                Judul
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                ISBN
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                Penulis
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                Penerbit
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                Kategori
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                Tahun
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                Stok
                            </th>

                            <th class="px-4 py-4 text-center align-middle">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <!-- BODY -->
                    <tbody>

                        @forelse($books as $book)

                            <tr class="border-b hover:bg-gray-50 transition">

                                <!-- COVER -->
                                <td class="px-4 py-4 text-center align-middle">

                                    @if($book->cover)

                                        <img src="{{ asset('storage/' . $book->cover) }}"
                                            class="w-16 h-20 object-cover rounded mx-auto">

                                    @else

                                        <div
                                            class="w-16 h-20 bg-gray-200 rounded mx-auto flex items-center justify-center text-xs text-gray-500">

                                            No Image

                                        </div>

                                    @endif

                                </td>

                                <!-- JUDUL -->
                                <td class="px-4 py-4 text-center align-middle">
                                    {{ $book->judul }}
                                </td>

                                <!-- ISBN -->
                                <td class="px-4 py-4 text-center align-middle">
                                    {{ $book->isbn ?? '-' }}
                                </td>

                                <!-- PENULIS -->
                                <td class="px-4 py-4 text-center align-middle">
                                    {{ $book->penulis }}
                                </td>

                                <!-- PENERBIT -->
                                <td class="px-4 py-4 text-center align-middle">
                                    {{ $book->penerbit }}
                                </td>

                                <!-- KATEGORI -->
                                <td class="px-4 py-4 text-center align-middle">
                                    {{ $book->kategori }}
                                </td>

                                <!-- TAHUN -->
                                <td class="px-4 py-4 text-center align-middle">
                                    {{ $book->tahun }}
                                </td>

                                <!-- STOK -->
                                <td class="px-4 py-4 text-center align-middle font-semibold">
                                    {{ $book->stok }}
                                </td>

                                <!-- AKSI -->
                                <td class="px-4 py-4 text-center align-middle">

                                    <div class="flex justify-center items-center gap-3">

                                        <a href="{{ route('admin.buku.show', $book->id) }}"
                                            class="text-blue-500 hover:underline">

                                            Detail

                                        </a>

                                        <a href="{{ route('admin.buku.edit', $book->id) }}"
                                            class="text-yellow-500 hover:underline">

                                            Edit

                                        </a>

                                        <form action="{{ route('admin.buku.destroy', $book->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">

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

                                <td colspan="9"
                                    class="text-center p-6 text-gray-500">

                                    Data buku tidak ditemukan

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="p-4 border-t flex justify-end">
                {{ $books->appends(request()->query())->links() }}
            </div>

        </div>

    </div>

@endsection