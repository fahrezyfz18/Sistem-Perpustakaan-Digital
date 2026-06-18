<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LeafShelf</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        .hero-bg {
            background: radial-gradient(circle at top right, rgba(154, 178, 131, 0.15), transparent),
                radial-gradient(circle at bottom left, rgba(188, 158, 95, 0.1), transparent);
        }
    </style>
    </head>

    <body class="bg-asparagus/30 text-kombu">

        {{-- Navbar --}}
        @include('components.navbar-guest')

        {{-- Content --}}
        {{ $slot }}

        {{-- Footer --}}
        @include('components.footer')


    </body>

</html>