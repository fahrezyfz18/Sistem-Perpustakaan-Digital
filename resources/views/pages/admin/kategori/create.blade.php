@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-background flex items-center justify-center p-6">
    
<div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-gray-100">

    <!-- HEADER -->
    <div class="bg-primary text-white p-5 rounded-t-2xl">
        <h1 class="text-xl md:text-2xl font-semibold text-center">
            Tambah Kategori
        </h1>
        <p class="text-sm text-center text-gray-200 mt-1">
            Tambahkan kategori buku baru
        </p>
    </div>

    <!-- FORM -->
    <div class="p-6">

        <form action="{{ route('admin.kategori.store') }}"
              method="POST"
              class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama"
                    placeholder="Masukkan nama kategori"
                    class="w-full border border-gray-300 rounded-lg p-3
                           placeholder:text-gray-400 placeholder:text-sm
                           focus:ring-2 focus:ring-primary
                           focus:border-primary
                           outline-none transition duration-200">
            </div>

            <button
                type="submit"
                class="w-full bg-secondary text-white py-3 rounded-lg
                       hover:bg-camel transition duration-300
                       font-semibold shadow-sm">
                Simpan
            </button>

        </form>

    </div>

</div>

</div>

@endsection
