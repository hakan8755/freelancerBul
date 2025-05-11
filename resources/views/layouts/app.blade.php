<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')

    {{-- AOS / Animate on Scroll --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    {{-- Bootstrap Icons (isteğe bağlı) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <div id="app">
        @include('partials.nav')

        <main class="py-4 {{ Request::is('/') ? 'mt-0' : 'mt-4' }}">
            <div class="container">
                @include('partials.session')
                @include('partials.errors')
                @yield('content')
            </div>
        </main>

        @include('partials.footer')
    </div>

    <script>
        AOS.init();
    </script>

    @stack('scripts')
</body>

</html>
