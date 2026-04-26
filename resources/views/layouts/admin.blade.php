<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="flex">

    {{-- Sidebar --}}
    @include('components.sidebar-admin')

    {{-- Content --}}
    <div class="ml-64 p-6 w-full">
        @yield('content')
    </div>

</body>
</html>