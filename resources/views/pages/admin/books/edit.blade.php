@extends('layouts.admin')

@section('content')
<div class="ml-64 p-6 bg-background min-h-screen">

    <h1 class="text-xl font-semibold text-primary mb-4">Edit Buku</h1>

    <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST"
          class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="judul" value="{{ $buku->judul }}" class="w-full border p-2 rounded">

        <input type="text" name="penulis" value="{{ $buku->penulis }}" class="w-full border p-2 rounded">

        <input type="text" name="kategori" value="{{ $buku->kategori }}" class="w-full border p-2 rounded">

        <input type="number" name="tahun" value="{{ $buku->tahun }}" class="w-full border p-2 rounded">

        <input type="number" name="stok" value="{{ $buku->stok }}" class="w-full border p-2 rounded">

        <button class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-camel">
            Update
        </button>
    </form>

</div>
@endsection