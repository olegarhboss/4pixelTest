<!DOCTYPE html>
<html lang={{ str_replace('_', '-', app()->getLocale()) }}>
<meta charset=utf-8>

{{--<link rel=preconnect href=https://cdn.jsdelivr.net>--}}
{{--<link rel=preconnect href=https://fonts.googleapis.com>--}}
<link rel=preconnect href=https://fonts.gstatic.com>

<title>{{ config('app.name') }}</title>

<meta name=author content="Oleg Polyakov">
<meta name=viewport content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv=X-UA-Compatible content="IE=Edge">

<!-- CSRF Token -->
{{-- <meta name=csrf-token content="{{ csrf_token() }}"> --}}

<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link rel=stylesheet href="{{ mix('css/app.css') }}">

<div id=js-app>
    @include('components.navigation')

    <main class=py-4>
        @yield('content')
    </main>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
</html>