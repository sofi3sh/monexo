<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('backend/production/favicon.ico') }}" type="image/x-icon">

    {{-- Link --}}
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/production/style/base.css') }}?{{ config('app.cabinet_css_ver') }}">
    <link rel="stylesheet" href="{{ asset('backend/production/style/style.css') }}?{{ config('app.cabinet_css_ver') }}">

    {{-- Media Styles --}}
    <link rel="stylesheet" href="{{ asset('backend/production/style/media.css') }}?{{ config('app.cabinet_css_ver') }}">

    {{-- Title & Description --}}
    <title>Monexo</title>
</head>
<body>

{{-- Loader --}}
<div id="page_loader">
    <span class="load"></span>
    <small>Loading...</small>
</div>

{{-- Header --}}
@include('backend.includes.partials.main_tags.header')

{{-- Сообщения --}}
@include('includes.partials.messages')

{{-- Content --}}
<div id="main" class="main">
    @yield('content')
</div>

{{-- Footer --}}
{{-- @include('backend.includes.partials.main_tags.footer') --}}

{{-- Help modal window --}}
@include('backend.includes.components.page_base.help_window')

{{-- Scripts zone --}}
{{-- jQuery --}}
<script src="{{ asset('backend/production/scripts/jquery.js') }}?{{ config('app.cabinet_js_ver') }}"></script>
{{-- Project --}}
<script src="{{ asset('backend/production/scripts/scripts.js') }}?{{ config('app.cabinet_js_ver') }}"></script>
{{-- Pagination --}}
<script src="{{ asset('backend/production/scripts/TablePagination.js') }}?{{ config('app.cabinet_js_ver') }}"></script>

{{-- Scripts zone --}}
@yield('scripts')

{{-- Website Support --}}
@include('includes.partials.re_plain')

{{-- @include('includes.partials.zendesk') --}}
</body>
</html>
