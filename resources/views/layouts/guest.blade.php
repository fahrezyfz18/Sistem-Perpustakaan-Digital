<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LeafShelf') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-primary font-sans antialiased">

    {{-- NAVBAR LANDING --}}
    @include('components.navbar-guest')

    {{-- 🔥 CONTENT (LANDING / HOME) --}}
    @hasSection('content')
        <main>
            @yield('content')
        </main>
    @endif

   {{-- AUTH --}}
@isset($slot)
<div class="min-h-screen flex items-center justify-center bg-[#dcdcc8] px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        {{-- LOGO --}}
        <div class="text-center mb-4">
            <img src="{{ asset('images/LOGO_LS.jpg') }}" class="w-70 mx-auto">
            <p class="text-base text-secondary italic mt-2 leading-relaxed">
                "Tumbuhkan minat baca di ruang teduh digital."
            </p>
        </div>

        {{ $slot }}

    </div>
</div>
@endisset

    {{-- FOOTER --}}
    @include('components.footer')

</body>
</html>