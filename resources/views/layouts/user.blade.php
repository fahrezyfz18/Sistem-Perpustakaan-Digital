<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>LeafShelf User</title>

    @vite('resources/css/app.css')

</head>

<body class="bg-background min-h-screen">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        @include('components.sidebar-user')

        <!-- MAIN -->
        <div class="flex-1 md:ml-64">

            <!-- NAVBAR -->
            @include('layouts.navigation')

            <!-- CONTENT -->
            <main class="p-6">

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>