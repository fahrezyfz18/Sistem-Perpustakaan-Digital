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

            <form method="POST" action="{{ route('admin.anggota.store') }}" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama
                    </label>
                    <input
                        type="text"
                        name="nama"
                        placeholder="Masukkan nama lengkap anggota"
                        class="w-full border border-gray-300 rounded-lg p-3
                               placeholder:text-gray-400 placeholder:text-sm
                               focus:ring-2 focus:ring-primary
                               focus:border-primary
                               outline-none transition duration-200">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        placeholder="contoh@email.com"
                        class="w-full border border-gray-300 rounded-lg p-3
                               placeholder:text-gray-400 placeholder:text-sm
                               focus:ring-2 focus:ring-primary
                               focus:border-primary
                               outline-none transition duration-200">
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        No HP
                    </label>
                    <input
                        type="text"
                        name="no_hp"
                        placeholder="08xxxxxxxxxx"
                        class="w-full border border-gray-300 rounded-lg p-3
                               placeholder:text-gray-400 placeholder:text-sm
                               focus:ring-2 focus:ring-primary
                               focus:border-primary
                               outline-none transition duration-200">
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat
                    </label>
                    <textarea
                        name="alamat"
                        rows="3"
                        placeholder="Masukkan alamat lengkap anggota"
                        class="w-full border border-gray-300 rounded-lg p-3
                               placeholder:text-gray-400 placeholder:text-sm
                               focus:ring-2 focus:ring-primary
                               focus:border-primary
                               outline-none transition duration-200"></textarea>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>
                    <select
                        name="status"
                        class="w-full border border-gray-300 rounded-lg p-3
                               text-gray-700
                               focus:ring-2 focus:ring-primary
                               focus:border-primary
                               outline-none transition duration-200">
                        <option value="" selected disabled>
                            Pilih status anggota
                        </option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non Aktif</option>
                    </select>
                </div>

                <!-- Button -->
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