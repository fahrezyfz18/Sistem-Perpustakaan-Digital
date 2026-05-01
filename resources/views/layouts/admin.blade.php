<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    @include('components.sidebar-admin')

    <!-- MAIN -->
    <div class="flex-1 ml-64">

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