<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    @include('components.sidebar-admin')

    <!-- OVERLAY -->
    <div 
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 z-30 md:hidden"
    ></div>

    <div class="flex-1 w-full md:ml-64">

        @include('layouts.navigation')

        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>

</html>