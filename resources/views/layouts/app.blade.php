<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hoidap247')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('components.header')

    <main class="container mx-auto max-w-7xl flex gap-4 py-6 px-2">
        @yield('content')
    </main>

    @include('components.footer')
    @stack('scripts')
</body>

</html>