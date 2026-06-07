@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <h1 class="text-2xl font-bold">
        {{ $kategori->nama }}
    </h1>

    <p class="mt-3">
        Jumlah Buku :
        {{ $kategori->books()->count() }}
    </p>

    <a href="{{ route('admin.kategori.index') }}"
       class="inline-block mt-4 bg-primary text-white px-4 py-2 rounded">

        Kembali

    </a>

</div>

@endsection