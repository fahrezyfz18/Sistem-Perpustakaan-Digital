@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-background flex items-center justify-center p-6">

        <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg border border-gray-100">

            <!-- HEADER -->
            <div class="bg-kombu text-white p-5 rounded-t-2xl text-center">
                <h1 class="text-xl font-semibold">Edit Profil</h1>
                <p class="text-sm text-gray-200 mt-1">
                    Perbarui informasi akun Anda
                </p>
            </div>

            <!-- FORM -->
            <div class="p-6">

                <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-4">

                    @csrf
                    @method('PATCH')

                    <!-- NAMA -->
                    <div>
                        <label class="text-sm text-gray-600">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-kombu outline-none">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-kombu outline-none">
                    </div>

                    <hr class="my-4">

                    <!-- PASSWORD LAMA -->
                    <div>
                        <label class="text-sm text-gray-600">Password Lama</label>
                        <input type="password" name="old_password"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-kombu outline-none"
                            placeholder="Masukkan password lama">
                    </div>

                    <!-- PASSWORD BARU -->
                    <div>
                        <label class="text-sm text-gray-600">Password Baru</label>
                        <input type="password" name="password"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-kombu outline-none"
                            placeholder="Password baru">
                    </div>

                    <!-- KONFIRMASI -->
                    <div>
                        <label class="text-sm text-gray-600">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-kombu outline-none"
                            placeholder="Ulangi password">
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-kombu text-white py-2 rounded-lg hover:bg-accent transition font-semibold">

                        Simpan Perubahan

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection