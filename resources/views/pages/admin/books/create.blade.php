@extends('layouts.admin')

@section('content')

<h1 class="text-xl font-semibold text-primary mb-4">Tambah Buku</h1>

<form action="{{ route('admin.buku.store') }}" method="POST"
      class="bg-white p-6 rounded shadow space-y-4">
    @csrf

    <input type="text" name="judul" placeholder="Judul" class="w-full border rounded-lg p-2">
    <input type="text" name="isbn" placeholder="ISBN" class="w-full border rounded-lg p-2">
    <input type="text" name="penulis" placeholder="Penulis" class="w-full border rounded-lg p-2">
    <input type="text" name="penerbit" placeholder="Penerbit" class="w-full border rounded-lg p-2">
    <input type="text" name="kategori" placeholder="Kategori" class="w-full border rounded-lg p-2">
    <input type="number" name="tahun" placeholder="Tahun" class="w-full border rounded-lg p-2">
    <input type="number" name="stok" placeholder="Stok" class="w-full border rounded-lg p-2">

    <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-accent">
        Simpan
    </button>
</form>

@endsection