<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('include.head')
    <title>Full Funnel - @yield('title')</title>
</head>
<body>
    <div id="app">
        @include('include.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('include.footer')
</body>
</html>
