@extends('layouts.admin')

@section('content')

<!-- WRAPPER -->
<div class="min-h-screen bg-background flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-gray-100">

        <!-- HEADER -->
        <div class="bg-primary text-white p-5 rounded-t-2xl">
            <h1 class="text-xl md:text-2xl font-semibold text-center">
                Edit Buku
            </h1>
            <p class="text-sm text-center text-gray-200 mt-1">
                Perbarui data buku
            </p>
        </div>

        @if(session('success'))
        <div class="mb-4 p-3 bg-olivine text-white rounded-lg shadow">
            {{ session('success') }}
        </div>
        @endif

        <!-- FORM -->
        <div class="p-6">

            <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- COVER -->
                <div>
                    <label class="text-sm text-gray-600">
                        Cover Buku
                    </label>

                    <input type="file"
                        name="cover"
                        class="w-full mt-1 border rounded-lg p-2"
                        accept="image/jpeg,image/png,image/jpg">

                    <p class="text-xs text-gray-400 mt-1">
                        Format: JPG, JPEG, PNG | Maks: 5MB
                    </p>
                </div>

                <p class="text-xs text-yellow-600 mt-1">
                    Kosongkan jika tidak ingin mengganti cover
                </p>

                @if($buku->cover)
                <div class="mt-2">
                    <p class="text-xs text-gray-500">Cover saat ini:</p>
                    <img src="{{ asset('storage/'.$buku->cover) }}"
                        class="w-20 h-28 object-cover rounded mt-1">
                </div>
                @endif

                <!-- JUDUL -->
                <div>
                    <label class="text-sm text-gray-600">Judul</label>
                    <input type="text" name="judul" value="{{ $buku->judul }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- ISBN -->
                <div>
                    <label class="text-sm text-gray-600">ISBN</label>
                    <input type="text" name="isbn" value="{{ $buku->isbn }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- PENULIS -->
                <div>
                    <label class="text-sm text-gray-600">Penulis</label>
                    <input type="text" name="penulis" value="{{ $buku->penulis }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- PENERBIT -->
                <div>
                    <label class="text-sm text-gray-600">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ $buku->penerbit }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <!-- KATEGORI -->
                <div>
                    <label class="text-sm text-gray-600">Kategori</label>

                    <select name="kategori_id"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">

                        <option value="">Pilih Kategori</option>

                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $buku->kategori_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="text-sm text-gray-600">Deskripsi</label>

                    <textarea name="deskripsi" rows="4"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">{{ $buku->deskripsi }}</textarea>
                </div>

                <!-- TAHUN & STOK -->
                <div class="grid grid-cols-2 gap-3">

                    <div>
                        <label class="text-sm text-gray-600">Tahun</label>
                        <input type="number" name="tahun" value="{{ $buku->tahun }}"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Stok</label>
                        <input type="number" name="stok" value="{{ $buku->stok }}"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                    </div>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-secondary text-white py-2 rounded-lg hover:bg-camel transition font-semibold">
                    Update Data
                </button>

            </form>

        </div>

    </div>

</div>

@endsection