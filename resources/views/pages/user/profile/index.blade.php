@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-background p-6">

        <div class="max-w-3xl mx-auto">

            <!-- CARD PROFILE -->
            <div class="bg-white rounded-2xl shadow border border-kombu/10 p-6">

                <h1 class="text-2xl font-bold text-kombu mb-6">
                    Profil Saya
                </h1>

                <!-- HEADER PROFILE -->
                <div class="flex items-center gap-5 mb-8">

                    <!-- FOTO -->
                    <div
                        class="w-20 h-20 rounded-full bg-kombu text-white flex items-center justify-center text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <!-- INFO SINGKAT -->
                    <div>
                        <h2 class="text-xl font-semibold">
                            {{ $user->name }}
                        </h2>

                        <p class="text-gray-500">
                            {{ $user->email }}
                        </p>

                        <span class="inline-block mt-1 text-xs bg-olivine/20 text-olivine px-2 py-1 rounded">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                </div>

                <!-- DETAIL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                    <div class="p-3 border rounded-lg">
                        <p class="text-gray-500">Username</p>
                        <p class="font-semibold">{{ $user->username ?? '-' }}</p>
                    </div>

                    <div class="p-3 border rounded-lg">
                        <p class="text-gray-500">No HP</p>
                        <p class="font-semibold">{{ $user->phone ?? '-' }}</p>
                    </div>

                    <div class="p-3 border rounded-lg md:col-span-2">
                        <p class="text-gray-500">Alamat</p>
                        <p class="font-semibold">{{ $user->address ?? '-' }}</p>
                    </div>

                    <div class="p-3 border rounded-lg">
                        <p class="text-gray-500">Email</p>
                        <p class="font-semibold">{{ $user->email }}</p>
                    </div>

                    <div class="p-3 border rounded-lg">
                        <p class="text-gray-500">Status</p>
                        <p class="font-semibold text-olivine">
                            Aktif
                        </p>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-6">
                    <a href="{{ route('user.profile.edit') }}"
                        class="bg-kombu text-white px-4 py-2 rounded-lg hover:bg-accent transition">

                        Edit Profil
                    </a>
                </div>

            </div>

        </div>

    </div>

@endsection