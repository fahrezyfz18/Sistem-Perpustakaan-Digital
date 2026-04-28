@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold text-kombu">Kelola Data Buku</h2>

    <a href="{{ route('admin.buku.create') }}"
       class="bg-mustard text-white px-4 py-2 rounded">
       + Tambah Buku
    </a>
</div>

@if(session('success'))
<div class="bg-olive text-white p-3 rounded mb-3">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded">
<table class="w-full">

    <thead class="bg-asparagus text-white">
        <tr>
            <th class="p-2">Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($books as $book)
        <tr class="border-b">
            <td class="p-2">{{ $book->judul }}</td>
            <td>{{ $book->penulis }}</td>
            <td>{{ $book->penerbit }}</td>
            <td>{{ $book->tahun }}</td>
            <td>
                <span class="bg-camel text-white px-2 py-1 rounded">
                    {{ $book->kategori }}
                </span>
            </td>

            <td class="flex gap-2 p-2">
                <a href="{{ route('admin.buku.edit', $book->id) }}"
                   class="bg-asparagus text-white px-2 py-1 rounded">
                   Edit
                </a>

                <form action="{{ route('admin.buku.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 rounded">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
</div>

@endsection