<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Monexo</title>
        <!-- <link rel="stylesheet" href="{{ asset('style/warnings.css') }}"/> -->
    </head>
    <body>
        <img  src="{{ asset('monexo/images/logo.png') }}" alt="Monexo">
        <h2 style="font-size: 96px;">@yield('code', __('Oh no'))</h2>
        <small>@yield('message')</small>
        <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">{{ __('website_base.errors.go_home') }}</a>
    </body>
</html>
