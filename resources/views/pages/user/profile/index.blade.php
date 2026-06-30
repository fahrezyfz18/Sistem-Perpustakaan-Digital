@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-background p-4 sm:p-6">
    <div class="max-w-3xl mx-auto space-y-6">
        <h1 class="text-2xl font-bold text-kombu">Profil Saya</h1>

        <div class="bg-white p-6 rounded-2xl shadow-sm border space-y-6">
            <div class="flex items-center gap-4 border-b pb-6">
                <div class="w-16 h-16 rounded-full overflow-hidden bg-kombu/10 border flex items-center justify-center">
                    @if($user->avatar)
                        <img src="{{ asset('avatars/'.$user->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-2xl text-kombu font-bold">{{ substr($user->name, 0, 1) }}</span>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <span class="text-sm text-gray-500">{{ $user->email }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Email</label>
                    <p class="text-gray-700 font-medium">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase">Nomor HP</label>
                    <p class="text-gray-700 font-medium">{{ $user->no_hp ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase">Alamat</label>
                    <p class="text-gray-700 font-medium">{{ $user->alamat ?? 'Belum diisi' }}</p>
                </div>
            </div>

            <div class="pt-4">
                <a href="{{ route('user.profile.edit') }}" class="bg-kombu text-white px-6 py-2 rounded-xl text-sm font-semibold">Edit Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection