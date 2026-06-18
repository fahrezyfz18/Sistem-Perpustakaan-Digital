@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-background flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-gray-100">

        <!-- HEADER -->
        <div class="bg-primary text-white p-5 rounded-t-2xl">
            <h1 class="text-xl md:text-2xl font-semibold text-center">
                Edit Anggota
            </h1>
            <p class="text-sm text-center text-gray-200 mt-1">
                Perbarui data anggota
            </p>
        </div>

        <!-- FORM -->
        <div class="p-6">

            <form method="POST" action="{{ route('admin.anggota.update', $anggota->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm text-gray-600">Nama</label>
                    <input type="text" name="nama" value="{{ $anggota->nama }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email" value="{{ $anggota->email }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-600">No HP</label>
                    <input type="text" name="no_hp" value="{{ $anggota->no_hp }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Alamat</label>
                    <textarea name="alamat"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">{{ $anggota->alamat }}</textarea>
                </div>

                <button class="w-full bg-secondary text-white py-2 rounded-lg hover:bg-camel transition font-semibold">
                    Update
                </button>

            </form>

        </div>

    </div>

</div>

@endsection