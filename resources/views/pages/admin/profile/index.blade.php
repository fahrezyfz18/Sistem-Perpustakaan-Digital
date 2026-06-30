@extends('layouts.app')

@section('content')

    <x-page title="Profil Admin" subtitle="Manajemen informasi data pribadi akun Anda">

        <div class="max-w-3xl bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-5 mb-6">
                
                <div class="w-16 h-16 bg-kombu text-white flex items-center justify-center rounded-full text-2xl font-bold shadow-sm">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h2 class="font-bold text-xl text-gray-900">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $user->email }}</p>
                </div>

            </div>

            <div class="border-t pt-5">
                <a href="{{ route('admin.profile.edit') }}"
                   class="inline-flex items-center justify-center bg-kombu hover:bg-opacity-90 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition-all">
                    Edit Profil
                </a>
            </div>
        </div>

    </x-page>

@endsection