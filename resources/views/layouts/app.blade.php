<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan Digital') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-background">

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    <!-- SIDEBAR -->
    @auth
        @if(auth()->user()->role === 'admin')
            @include('components.sidebar-admin')
        @else
            @include('components.sidebar-user')
        @endif
    @endauth

    <!-- MAIN -->
    <div class="flex-1 md:ml-64 w-full">

        <!-- NAVBAR -->
        @include('layouts.navigation')

        <!-- CONTENT -->
        <main class="p-4 md:p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>