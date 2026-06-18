@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-bold mb-4">Data Kategori</h1>

    <a href="{{ route('admin.kategori.create') }}" class="bg-primary text-white px-4 py-2 rounded">
        + Tambah Kategori
    </a>

    <table class="w-full mt-4 bg-white shadow rounded">
        <thead>
            <tr class="border-b">
                <th class="p-2 text-left">Nama</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $category)
                <tr class="border-b">
                    <td class="p-2">{{ $category->nama }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.kategori.edit', $category->id) }}" class="text-blue-600">Edit</a>

                        <form action="{{ route('admin.kategori.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 ml-2">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection