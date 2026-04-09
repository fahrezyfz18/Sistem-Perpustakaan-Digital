@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-8 border-kombu">

    <!-- LOGO -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/LOGO_LS.JPG') }}" alt="LeafShelf Logo" class="w-45 object-contain">
    </div>

    <p class="text-center text-mustard text-sm mb-8 italic">
        "Tumbuhkan minat baca di ruang teduh digital."
    </p>

    <!-- FORM -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NAMA -->
        <div class="mb-4">
            <label class="block text-kombu font-semibold text-sm">Nama Lengkap</label>
            <input type="text" name="name" placeholder="Masukkan nama"
                class="w-full mt-1 px-4 py-2 border border-olivine rounded-lg focus:ring-2 focus:ring-asparagus outline-none">
        </div>

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="block text-kombu font-semibold text-sm">Email</label>
            <input type="email" name="email" placeholder="Masukkan email"
                class="w-full mt-1 px-4 py-2 border border-olivine rounded-lg focus:ring-2 focus:ring-asparagus outline-none">
        </div>

        <!-- NO HP (DARI ERD) -->
        <div class="mb-4">
            <label class="block text-kombu font-semibold text-sm">No. HP</label>
            <input type="text" name="no_hp" placeholder="Masukkan nomor HP"
                class="w-full mt-1 px-4 py-2 border border-olivine rounded-lg focus:ring-2 focus:ring-asparagus outline-none">
        </div>

        <!-- ALAMAT (DARI ERD) -->
        <div class="mb-4">
            <label class="block text-kombu font-semibold text-sm">Alamat</label>
            <textarea name="alamat" placeholder="Masukkan alamat"
                class="w-full mt-1 px-4 py-2 border border-olivine rounded-lg focus:ring-2 focus:ring-asparagus outline-none"></textarea>
        </div>

        <!-- PASSWORD -->
        <div class="mb-4">
            <label class="block text-kombu font-semibold text-sm">Password</label>
            <input type="password" name="password" placeholder="Masukkan password"
                class="w-full mt-1 px-4 py-2 border border-olivine rounded-lg focus:ring-2 focus:ring-asparagus outline-none">
        </div>

        <!-- KONFIRMASI -->
        <div class="mb-6">
            <label class="block text-kombu font-semibold text-sm">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Ulangi password"
                class="w-full mt-1 px-4 py-2 border border-olivine rounded-lg focus:ring-2 focus:ring-asparagus outline-none">
        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="w-full bg-kombu text-white py-3 rounded-lg font-bold hover:bg-opacity-90">
            Daftar
        </button>
    </form>

    <!-- LINK LOGIN -->
    <p class="text-center text-sm text-gray-600 mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-mustard font-bold hover:text-camel">
            Login di sini
        </a>
    </p>

</div>
@endsection