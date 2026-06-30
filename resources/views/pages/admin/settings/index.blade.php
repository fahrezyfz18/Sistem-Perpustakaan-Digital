@extends('layouts.app')

@section('content')

    <x-page title="Pengaturan Sistem" subtitle="Kelola konfigurasi dan aturan dasar aplikasi perpustakaan">

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl font-medium shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <form method="POST" action="#">
                    @csrf
                    
                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-50">
                            <svg class="w-5 h-5 text-kombu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <h2 class="font-bold text-gray-900 text-lg">Keamanan Akun</h2>
                        </div>

                        <p class="text-xs text-gray-500 mb-6">
                            Pastikan Anda mengingat password saat ini untuk melakukan pembaruan keamanan akun.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Password Lama</label>
                                <input type="password" name="current_password" class="w-full mt-1.5 border border-gray-200 focus:border-kombu focus:ring-2 focus:ring-kombu/20 outline-none rounded-xl py-2.5 px-4 text-sm text-gray-700 transition-all placeholder-gray-400" placeholder="Masukkan password saat ini">
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Password Baru</label>
                                <input type="password" name="password" class="w-full mt-1.5 border border-gray-200 focus:border-kombu focus:ring-2 focus:ring-kombu/20 outline-none rounded-xl py-2.5 px-4 text-sm text-gray-700 transition-all placeholder-gray-400" placeholder="Masukkan password baru">
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full mt-1.5 border border-gray-200 focus:border-kombu focus:ring-2 focus:ring-kombu/20 outline-none rounded-xl py-2.5 px-4 text-sm text-gray-700 transition-all placeholder-gray-400" placeholder="Ulangi password baru">
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-6 mt-6 border-t border-gray-50">
                        <button type="submit" class="bg-kombu hover:bg-opacity-90 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all w-full sm:w-auto">
                            Simpan Password
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="h-full flex flex-col justify-between m-0">
                    @csrf
                    @method('PUT')

                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-3 border-b border-gray-50">
                            <svg class="w-5 h-5 text-olivine" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M5 8h14M5 16h14M5 20h14M5 4h14" />
                            </svg>
                            <h2 class="font-bold text-gray-900 text-lg">Sirkulasi Konfigurasi</h2>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Batas Hari Pinjam</label>
                                <input type="number" name="batas_hari" class="w-full mt-1.5 border border-gray-200 focus:border-kombu focus:ring-2 focus:ring-kombu/20 outline-none rounded-xl py-2.5 px-4 text-sm text-gray-700 transition-all" value="{{ $setting->batas_hari ?? 7 }}">
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Denda per Hari (Rp)</label>
                                <input type="number" name="denda_per_hari" class="w-full mt-1.5 border border-gray-200 focus:border-kombu focus:ring-2 focus:ring-kombu/20 outline-none rounded-xl py-2.5 px-4 text-sm text-gray-700 transition-all" value="{{ $setting->denda_per_hari ?? 2000 }}">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-gray-50">
                        <button type="submit" class="bg-olivine hover:bg-opacity-90 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all w-full sm:w-auto">
                            Simpan Aturan
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </x-page>

@endsection