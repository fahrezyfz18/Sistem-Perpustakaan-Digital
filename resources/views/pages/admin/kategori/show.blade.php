@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-background flex items-center justify-center p-6">

<div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-gray-100">

    <!-- HEADER -->
    <div class="bg-primary text-white p-5 rounded-t-2xl">
        <h1 class="text-xl md:text-2xl font-semibold text-center">
            Detail Kategori
        </h1>
        <p class="text-sm text-center text-gray-200 mt-1">
            Informasi kategori buku
        </p>
    </div>

    <!-- CONTENT -->
    <div class="p-6 space-y-5">

        <div>
            <p class="text-xs uppercase text-gray-500 mb-1">
                Nama Kategori
            </p>

            <p class="font-medium text-gray-800">
                {{ $kategori->nama }}
            </p>
        </div>

        <div>
            <p class="text-xs uppercase text-gray-500 mb-1">
                Jumlah Buku
            </p>

            <p class="font-medium text-gray-800">
                {{ $kategori->books()->count() }}
            </p>
        </div>

        <a href="{{ route('admin.kategori.index') }}"
           class="block w-full text-center bg-secondary text-white py-3 rounded-lg
                  hover:bg-camel transition duration-300 font-semibold shadow-sm">
            Kembali
        </a>

    </div>

</div>

</div>

@endsection
