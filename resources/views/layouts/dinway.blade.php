<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Monexo – надёжный партнёр в мире инвестиций')">
    <meta name="keywords" content="@yield('keywords', 'Monexo, money, investment, инвестиции, доход, прибыль, деньги')">
    <meta property="og:title" content="Monexo">
    <meta property="og:description" content="Your reliable partner in the world of investments">
    <link rel="preload" href="{{asset('css/dinway.css')}}" as="style">
    <link rel="preload" href="{{asset('js/dinway.js')}}" as="script">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dinway.css')}}">
    @yield('css')


    <title>
        @if(isset($title))
            Monexo – @lang($title)
        @else
            Monexo
        @endif
    </title>
</head>
<body class="page">

    @include('dinway.chunks.header')

    <main>
        @yield('content')
    </main>

    @include('dinway.chunks.overlay')

    @if($errors->any())
        @include('dinway.chunks.modals.modal-errors', ['errors' => $errors])
    @endif

    @if(Session::has('successMessage'))
        @include('dinway.chunks.modals.modal-success', ['info' => Session::get('successMessage')]);
    @endif

    @include('dinway.chunks.modals.modal-success', ['info' => __('dinway.news-subscription.successMessage')]);

    @include('dinway.chunks.footer')

    @include('helpers.js-localisation')
    <script src="{{ asset('js/dinway.js') }}"></script>
</body>
</html>

