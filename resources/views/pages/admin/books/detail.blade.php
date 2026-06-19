@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    ```
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- COVER -->
            <div class="p-6">

                @if($buku->cover)

                <img
                    src="{{ asset('storage/' . $buku->cover) }}"
                    alt="{{ $buku->judul }}"
                    class="w-full rounded-xl shadow">

                @else

                <div class="h-96 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">

                    No Cover

                </div>

                @endif

            </div>

            <!-- CONTENT -->
            <div class="md:col-span-2 p-6">

                <!-- TITLE -->
                <h1 class="text-3xl font-bold text-kombu">

                    {{ $buku->judul }}

                </h1>

                <!-- AUTHOR -->
                <p class="text-gray-500 mt-2">

                    {{ $buku->penulis }}

                </p>

                <!-- DETAIL -->
                <div class="mt-6 space-y-3">

                    <div>
                        <span class="font-semibold">
                            ISBN:
                        </span>

                        {{ $buku->isbn ?? '-' }}
                    </div>

                    <div>
                        <span class="font-semibold">
                            Penerbit:
                        </span>

                        {{ $buku->penerbit }}
                    </div>

                    <div>
                        <span class="font-semibold">
                            Tahun:
                        </span>

                        {{ $buku->tahun }}
                    </div>

                    <div>
                        <span class="font-semibold">
                            Kategori:
                        </span>

                        {{ $buku->kategori }}
                    </div>

                    <div>
                        <span class="font-semibold">
                            Stok:
                        </span>

                        {{ $buku->stok }}
                    </div>

                </div>

                <!-- DESKRIPSI -->
                <div class="mt-6">

                    <h3 class="font-semibold text-lg text-kombu mb-2">

                        Deskripsi

                    </h3>

                    <p class="text-gray-600 leading-relaxed">

                        {{ $buku->deskripsi ?? 'Tidak ada deskripsi buku.' }}

                    </p>

                </div>

                <!-- ACTION -->
                <div class="mt-8 flex gap-3">

                    <a href="{{ route('admin.buku.edit', $buku->id) }}"
                        class="inline-block bg-mustard text-white px-6 py-3 rounded-xl hover:opacity-90 transition">

                        Edit Buku

                    </a>

                    <a href="{{ route('admin.buku.index') }}"
                        class="inline-block bg-primary text-white px-6 py-3 rounded-xl hover:opacity-90 transition">

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>
    ```

</div>

@endsection