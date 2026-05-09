@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <div class="grid md:grid-cols-3 gap-8">

            <!-- COVER -->
            <div>

                @if($buku->cover)

                    <img
                        src="{{ asset('storage/' . $buku->cover) }}"
                        class="w-full rounded-xl shadow">

                @else

                    <div class="bg-gray-200 h-80 rounded-xl flex items-center justify-center">
                        Tidak Ada Cover
                    </div>

                @endif

            </div>

            <!-- DETAIL -->
            <div class="md:col-span-2 space-y-4">

                <h1 class="text-3xl font-bold text-primary">
                    {{ $buku->judul }}
                </h1>

                <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>

                <p><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>

                <p><strong>Kategori:</strong> {{ $buku->kategori }}</p>

                <p><strong>Tahun:</strong> {{ $buku->tahun }}</p>

                <p><strong>Stok:</strong> {{ $buku->stok }}</p>

                <div>

                    <h2 class="font-semibold text-lg text-primary mb-2">
                        Deskripsi
                    </h2>

                    <p class="text-gray-600 leading-relaxed">
                        {{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>

                </div>

                <a
                    href="{{ route('admin.buku.index') }}"
                    class="inline-block mt-4 bg-primary text-white px-5 py-2 rounded-lg">

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

@endsection