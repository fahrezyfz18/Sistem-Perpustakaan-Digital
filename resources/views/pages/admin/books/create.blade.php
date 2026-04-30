@extends('layouts.admin')

@section('content')

<div class="flex justify-center items-center min-h-screen bg-background">

    <div class="w-full max-w-md bg-white p-6 rounded-2xl shadow-lg">

        <h1 class="text-xl font-semibold text-primary mb-6 text-center">
            Tambah Buku
        </h1>

        <form action="{{ route('admin.buku.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="judul" placeholder="Judul" class="w-full border rounded-lg p-2">
            <input type="text" name="isbn" placeholder="ISBN" class="w-full border rounded-lg p-2">
            <input type="text" name="penulis" placeholder="penulis" class="w-full border rounded-lg p-2">
            <input type="text" name="penerbit" placeholder="Penerbit" class="w-full border rounded-lg p-2">
            <input type="text" name="kategori" placeholder="Kategori" class="w-full border rounded-lg p-2">
            <input type="number" name="tahun" placeholder="Tahun" class="w-full border rounded-lg p-2">
            <input type="number" name="stok" placeholder="Stok" class="w-full border rounded-lg p-2">

            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-accent">
                Simpan
            </button>
        </form>

    </div>

</div>

@endsection