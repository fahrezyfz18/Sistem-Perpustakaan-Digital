@extends('layouts.admin')

@section('content')
<div class="ml-64 p-6 bg-background min-h-screen">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold text-primary mb-4">{{ $buku->judul }}</h2>

        <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
        <p><strong>Kategori:</strong> {{ $buku->kategori }}</p>
        <p><strong>Tahun:</strong> {{ $buku->tahun }}</p>
        <p><strong>Stok:</strong> {{ $buku->stok }}</p>

        <a href="{{ route('admin.buku.index') }}"
           class="inline-block mt-4 bg-primary text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

</div>
@endsection