<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Auth favicon--}}
    <link rel="icon" href="{{ asset('img/dashboard/favicon.png') }}">


    <!-- Styles -->
    <link href="{{ asset('css/dashboard/dashboard.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <main class="py-4">

        <img class="d-block m-auto mt-5" src="{{ asset('img/dashboard/brand.png')  }}">

        @yield('content')
    </main>
</div>
</body>
</html>
