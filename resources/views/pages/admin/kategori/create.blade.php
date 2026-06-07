@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-bold mb-4">Tambah Kategori</h1>

    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <input type="text" name="nama" class="w-full border p-2" placeholder="Nama kategori">

        <button class="bg-primary text-white px-4 py-2 mt-3 rounded">
            Simpan
        </button>
    </form>
@endsection