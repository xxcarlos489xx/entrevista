<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo') | Entrevista</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('assets/admin/css/home/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
    @include('layouts.navbar')
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('assets/admin/js/home/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
