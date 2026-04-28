@extends('layouts.admin')

@section('content')
<div class="ml-64 p-6 bg-background min-h-screen">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-primary">Kelola Data Buku</h1>
        <a href="{{ route('admin.buku.create') }}"
           class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-camel transition">
            + Tambah Buku
        </a>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-olivine text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm text-left">
            
            <!-- HEAD -->
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-3">Judul</th>
                    <th class="p-3 text-center">ISBN</th>
                    <th class="p-3">Penulis</th>
                    <th class="p-3">Penerbit</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3 text-center">Tahun</th>
                    <th class="p-3 text-center">Stok</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($books as $book)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">{{ $book->judul }}</td>

                    <td class="p-3 text-center">
                        {{ $book->isbn ?? '-' }}
                    </td>

                    <td class="p-3">{{ $book->penulis }}</td>

                    <td class="p-3">{{ $book->penerbit }}</td>

                    <td class="p-3">{{ $book->kategori }}</td>

                    <td class="p-3 text-center">{{ $book->tahun }}</td>

                    <td class="p-3 text-center">{{ $book->stok }}</td>

                    <!-- AKSI -->
                    <td class="p-3 text-center space-x-2">

                        <a href="{{ route('admin.buku.show', $book->id) }}"
                           class="text-blue-500 hover:underline">
                            Detail
                        </a>

                        <a href="{{ route('admin.buku.edit', $book->id) }}"
                           class="text-yellow-500 hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('admin.buku.destroy', $book->id) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-500 hover:underline"
                                    onclick="return confirm('Yakin hapus data ini?')">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="8" class="text-center p-4 text-gray-500">
                        Data buku belum ada
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

        <!-- Pagination -->
        <div class="p-4">
            {{ $books->links() }}
        </div>
    </div>

</div>
@endsection