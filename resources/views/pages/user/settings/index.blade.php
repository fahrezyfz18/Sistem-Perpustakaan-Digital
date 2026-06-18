@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-background p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-3xl font-bold text-kombu">
            Pengaturan Akun
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Kelola keamanan akun Anda
        </p>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- GRID (FOLLOW ADMIN STYLE) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- CARD PASSWORD -->
        <div class="bg-white p-6 rounded-2xl shadow border border-kombu/10 lg:col-span-2">

            <!-- CARD HEADER -->
            <div class="flex items-center gap-3 mb-5">

                <svg class="w-5 h-5 text-kombu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>

                <h2 class="font-semibold text-kombu text-lg">
                    Ubah Password
                </h2>

            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('user.settings.password.update') }}">
                @csrf
                @method('PATCH')

                <div class="space-y-4">

                    <!-- PASSWORD LAMA -->
                    <div>
                        <label class="text-sm text-gray-600">
                            Password Lama
                        </label>

                        <input type="password" name="current_password"
                            class="w-full mt-1 rounded-lg border-gray-200 focus:border-kombu focus:ring-kombu"
                            placeholder="Masukkan password lama">
                    </div>

                    <!-- PASSWORD BARU -->
                    <div>
                        <label class="text-sm text-gray-600">
                            Password Baru
                        </label>

                        <input type="password" name="password"
                            class="w-full mt-1 rounded-lg border-gray-200 focus:border-kombu focus:ring-kombu"
                            placeholder="Masukkan password baru">
                    </div>

                    <!-- KONFIRMASI -->
                    <div>
                        <label class="text-sm text-gray-600">
                            Konfirmasi Password
                        </label>

                        <input type="password" name="password_confirmation"
                            class="w-full mt-1 rounded-lg border-gray-200 focus:border-kombu focus:ring-kombu"
                            placeholder="Ulangi password baru">
                    </div>

                </div>

                <button type="submit"
                    class="mt-5 bg-kombu text-white px-4 py-2 rounded-lg hover:bg-accent transition">
                    Simpan Password
                </button>

            </form>

        </div>

    </div>

</div>

@endsection