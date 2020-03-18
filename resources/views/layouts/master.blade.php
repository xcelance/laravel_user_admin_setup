<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Full Funnel - @yield('title')</title>

        <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    </head>
    <body>
    	<div class="container">
    		@yield('content')
    	</div>
		<script src="{{ asset('public/js/app.js') }}" defer></script>
    </body>
</html>