@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold text-kombu mb-6">Profile Admin</h1>

    <div class="flex items-center gap-4 mb-6">

        <div class="w-16 h-16 bg-kombu text-white flex items-center justify-center rounded-full text-xl">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div>
            <h2 class="font-semibold text-lg">{{ $user->name }}</h2>
            <p class="text-gray-500">{{ $user->email }}</p>
        </div>

    </div>

    <a href="{{ route('admin.profile.edit') }}"
       class="bg-kombu text-white px-4 py-2 rounded hover:bg-asparagus transition">
        Edit Profile
    </a>

</div>

@endsection