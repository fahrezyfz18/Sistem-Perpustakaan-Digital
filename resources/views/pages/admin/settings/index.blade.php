@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-background p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-3xl font-bold text-kombu">Pengaturan Sistem</h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola konfigurasi aplikasi perpustakaan
        </p>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- GRID SETTINGS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- UBAH PASSWORD -->
        <div class="bg-white p-6 rounded-2xl shadow border border-kombu/10">

            <div class="flex items-center gap-3 mb-5">
                <svg class="w-5 h-5 text-kombu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>

                <h2 class="font-semibold text-kombu text-lg">Ubah Password</h2>
            </div>

            <form method="POST" action="#">
                @csrf

                <div class="space-y-4">

                    <div>
                        <label class="text-sm text-gray-600">Password Baru</label>
                        <input type="password"
                            class="w-full mt-1 rounded-lg border-gray-200 focus:border-kombu focus:ring-kombu"
                            placeholder="Masukkan password baru">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Konfirmasi Password</label>
                        <input type="password"
                            class="w-full mt-1 rounded-lg border-gray-200 focus:border-kombu focus:ring-kombu"
                            placeholder="Ulangi password">
                    </div>

                </div>

                <button type="submit"
                    class="mt-5 bg-kombu text-white px-4 py-2 rounded-lg hover:bg-accent transition">
                    Simpan Password
                </button>

            </form>
        </div>


        <!-- ATURAN PEMINJAMAN -->
        <div class="bg-white p-6 rounded-2xl shadow border border-olivine/20">

            <div class="flex items-center gap-3 mb-5">
                <svg class="w-5 h-5 text-olivine" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6M5 8h14M5 16h14M5 20h14M5 4h14" />
                </svg>

                <h2 class="font-semibold text-olivine text-lg">
                    Aturan Peminjaman
                </h2>
            </div>

            <!-- FORM SETTINGS -->
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf

                <div class="space-y-4">

                    <!-- BATAS HARI -->
                    <div>
                        <label class="text-sm text-gray-600">
                            Batas Hari Pinjam
                        </label>

                        <input
                            type="number"
                            name="batas_hari"
                            class="w-full mt-1 rounded-lg border-gray-200 focus:border-olivine focus:ring-olivine"
                            value="{{ $setting->batas_hari ?? 7 }}">
                    </div>

                    <!-- DENDA -->
                    <div>
                        <label class="text-sm text-gray-600">
                            Denda per Hari (Rp)
                        </label>

                        <input
                            type="number"
                            name="denda_per_hari"
                            class="w-full mt-1 rounded-lg border-gray-200 focus:border-olivine focus:ring-olivine"
                            value="{{ $setting->denda_per_hari ?? 2000 }}">
                    </div>

                </div>

                <button type="submit"
                    class="mt-5 bg-olivine text-white px-4 py-2 rounded-lg hover:bg-asparagus transition">
                    Simpan Aturan
                </button>

            </form>
        </div>


        <!-- NOTIFIKASI -->
        <div class="bg-white p-6 rounded-2xl shadow border border-mustard/20">

            <div class="flex items-center gap-3 mb-5">
                <svg class="w-5 h-5 text-mustard" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
                </svg>

                <h2 class="font-semibold text-mustard text-lg">
                    Notifikasi Sistem
                </h2>
            </div>

            <form method="POST" action="#">
                @csrf

                <div class="space-y-4 text-sm text-gray-600">

                    <label class="flex items-center justify-between">
                        <span>Notifikasi Peminjaman</span>
                        <input type="checkbox" class="accent-mustard">
                    </label>

                    <label class="flex items-center justify-between">
                        <span>Notifikasi Pengembalian</span>
                        <input type="checkbox" class="accent-mustard">
                    </label>

                    <label class="flex items-center justify-between">
                        <span>Notifikasi Denda</span>
                        <input type="checkbox" class="accent-mustard">
                    </label>

                </div>

                <button type="submit"
                    class="mt-5 bg-mustard text-white px-4 py-2 rounded-lg hover:bg-camel transition">
                    Simpan Notifikasi
                </button>

            </form>
        </div>

    </div>

</div>

@endsection