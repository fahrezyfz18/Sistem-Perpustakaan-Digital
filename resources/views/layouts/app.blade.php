<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan Digital') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Flowbite -->
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>

<body class="font-sans antialiased bg-background">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @auth
        @if(auth()->user()->role === 'admin')
            @include('components.sidebar-admin')
        @else
            @include('components.sidebar-user')
        @endif
    @endauth

    <!-- MAIN CONTENT -->
    <div class="flex-1 ml-64">

        <!-- NAVBAR -->
        @include('layouts.navigation')

        <!-- HEADER -->
        @isset($header)
            <header class="bg-white shadow">
<div class="px-6 py-6">                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- CONTENT -->
        <main class="p-6">
            {{ $slot }}
        </main>

    </div>

</div>

</body>
</html>