@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-background flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-gray-100">

        <!-- HEADER -->
        <div class="bg-primary text-white p-5 rounded-t-2xl">
            <h1 class="text-xl md:text-2xl font-semibold text-center">
                Tambah Anggota
            </h1>
            <p class="text-sm text-center text-gray-200 mt-1">
                Masukkan data anggota baru
            </p>
        </div>

        <!-- FORM -->
        <div class="p-6">

            <form method="POST" action="{{ route('admin.anggota.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm text-gray-600">Nama</label>
                    <input type="text" name="nama"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-600">No HP</label>
                    <input type="text" name="no_hp"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Alamat</label>
                    <textarea name="alamat"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none"></textarea>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Status</label>
                    <select name="status"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-primary outline-none">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non Aktif</option>
                    </select>
                </div>

                <button class="w-full bg-secondary text-white py-2 rounded-lg hover:bg-camel transition font-semibold">
                    Simpan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection